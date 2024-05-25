<?php

namespace X48t96pa\Kintone\Models;

use X48t96pa\Kintone\Api\ConnectionResolverInterface as Resolver;
use X48t96pa\Kintone\Exceptions\JsonEncodingException;

/**
 * Kintone API 接続クライアント 兼 エンティテいなどのモデル
 * Illuminate\Database\Eloquent\Modelを意識
 * 
 * TODO:まずは ゴールとして...
 *  - 接続情報の確立 configの内容から kitnone APIアクセス情報をModelに反映できるようにする DBの代わりに
 *  - Guzzleとかでの接続Clientの確立
 *  - extends したクラスで API 連携できる
 */
abstract class KintoneModel
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection;

    /**
     * 接続する Kintone アプリ ID(record.jsonの時)
     * TODO: または名前がいいのか？user.json系
     *
     * @var int
     */
    protected $app;

    /**
     * PK フィールドコード for the model.
     *
     * @var string
     */
    protected $primaryKey = '$id';

    /**
     * __toString オブジェクトの文字列表現をエスケープするやつ
     *
     * @var bool true:エスケープ
     */
    protected $escapeWhenCastingToString = false;

    /**
     * Kintone API 接続器確立 クラス
     *
     * @var \X48t96pa\Kintone\Api\ConnectionResolverInterface
     */
    protected static $resolver;

    /**
     * コンストラクタ
     * @param array $attributes 
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        //　boot系のイベント発火 →　めっちゃ後でやる
        // $this->bootIfNotBooted();
        // traitの関数をstaticで使えるようにするやつっぽい
        // $this->initializeTraits();
        // よーわからん → HasAttributes trait 何の動作?
        // $this->syncOriginal();
        // モデルにsetするby fillableとか →　これはやる
        // $this->fill($attributes);
    }
    /* domain */

    /**
     * static 呼び出し
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder
     */
    public static function query()
    {
        return (new static)->newQuery();
    }

    /**
     * クエリビルダーの生成 for the model's api.
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder
     */
    public function newQuery()
    {
        // TODO:一旦 globalScopesは 使わない Query製造機を頑張ってみる
        // return $this->registerGlobalScopes($this->newQueryWithoutScopes());
        return $this->newQueryWithoutScopes();
    }

    /**
     * Kintone API Queryビルダーの作成
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder|static
     */
    public function newModelQuery()
    {
        return $this->newEloquentBuilder(
            $this->newBaseQueryBuilder()
        )->setModel($this);
    }

    /**
     * グローバルスコープ使わない Queryビルダーの生成
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder|static
     */
    public function newQueryWithoutScopes()
    {
        return $this->newModelQuery()
            // TODO: 将来的には relation対応
            // ->with($this->with)
            // ->withCount($this->withCount);
        ;
    }

    /**
     * TODO: 作るべきはこっちか... newBaseQueryBuilderだるいな
     * Create a new Eloquent query builder for the model.
     * Eloquent Queryビルダーの生成 TODO: newEloquentBuilder からの名前は最後らへんにリファクタ
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder|static
     */
    public function newEloquentBuilder($query)
    {
        // return new Builder($query);
        return $query;
    }

    /**
     * 接続情報に対応した Queryビルダーのインスタンス作成
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder
     */
    protected function newBaseQueryBuilder()
    {
        return $this->getConnection()->query();
    }

    /* utility系 */
    /**
     * @return array 配列表現
     */
    public function toArray()
    {
        // TODO: HasAttributesとかのtraitsの内容今後解析してちゃんとやる
        return [];
        // return array_merge($this->attributesToArray(), $this->relationsToArray());
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \Illuminate\Database\Eloquent\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        // JSONエンコード
        $json = json_encode($this->jsonSerialize(), $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * JSONへのシリアライズ
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    /* getter, setter */
    /**
     * Kintone API接続器 取得 for the model.
     * @return \X48t96pa\Kintone\Api\Connection
     */
    public function getConnection()
    {
        return static::resolveConnection($this->getConnectionName());
    }

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return $this->connection;
    }

    /**
     * Set the connection associated with the model.
     *
     * @param  string|null  $name
     * @return $this
     */
    public function setConnection($name)
    {
        $this->connection = $name;

        return $this;
    }

    /**
     * Kintone API接続器 確立
     * @param  string|null  $connection 接続設定情報 エイリアス
     * @return \X48t96pa\Kintone\Api\Connection
     */
    public static function resolveConnection($connection = null)
    {
        return static::$resolver->connection($connection);
    }

    /**
     * Get the connection resolver instance.
     *
     * @return \X48t96pa\Kintone\Api\ConnectionResolverInterface|null
     */
    public static function getConnectionResolver()
    {
        return static::$resolver;
    }

    /**
     * Set the connection resolver instance.
     *
     * @param  \X48t96pa\Kintone\Api\ConnectionResolverInterface  $resolver
     * @return void
     */
    public static function setConnectionResolver(Resolver $resolver)
    {
        static::$resolver = $resolver;
    }

    /**
     * Unset the connection resolver for models.
     *
     * @return void
     */
    public static function unsetConnectionResolver()
    {
        static::$resolver = null;
    }

    /* マジックメソッド */
    /**
     * 関数名から動的呼び出し 便利にするよう
     * @param  string  $method 呼び出すメソッド名
     * @param  array  $parameters　メソッドの引数
     * @return mixed それぞれの結果
     */
    public function __call($method, $parameters)
    {
        // TODO: Modelの__callの解析結果
        // 優先順位1. 内部メソッドの呼び出し
        // if (in_array($method, ['increment', 'decrement', 'incrementQuietly', 'decrementQuietly'])) {
        //     return $this->$method(...$parameters);
        // }
        // 優先順位2. relation系に関わる関数
        // if ($resolver = $this->relationResolver(static::class, $method)) {
        //     return $resolver($this);
        // }
        // 優先順位3. has one through系 これはキツイかな
        // if (Str::startsWith($method, 'through') &&
        //     method_exists($this, $relationMethod = Str::of($method)->after('through')->lcfirst()->toString())) {
        //     return $this->through($relationMethod);
        // }
        // 優先順位4. ForwardsCalls(trait リフレクションするだけのクラスっぽいやつ)->forwardCallTo 経由で QueryBuilderのmethodを実行
        // return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }

    /**
     * static関数での call
     * @param  string  $method 呼び出すメソッド名
     * @param  array  $parameters　メソッドの引数
     * @return mixed それぞれの結果
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    // TODO: toJsonの内容ちゃんとしたら実装
    // /**
    //  * 文字列化(エスケープ指示あり ? エスケープ JSON文字列 : JSON文字列)
    //  * @return string
    //  */
    // public function __toString()
    // {
    //     return $this->escapeWhenCastingToString
    //         ? e($this->toJson())
    //         : $this->toJson();
    // }

    public function test(): string
    {
        return 'Hello Composer World!!!!';
    }
}