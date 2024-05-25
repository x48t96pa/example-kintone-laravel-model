<?php

namespace X48t96pa\Kintone\Query;

use X48t96pa\Kintone\Api\ConnectionInterface;

/**
 * Kintone API クエリビルダー
 * TODO: 次 一旦 Illuminate\Database\Eloquent\Builder側の Builderを真似て作る
 * TODO: まずは 参照から作り後々 insert, update, deleteとかに...
 * TODO: records.json系以外がよくわかってないw record.jsonとの切り分けどうしようっか....
 */
class KintoneAPIBuilder
{
    /* field */
    /**
     * Kintone API 接続器
     * @var \X48t96pa\Kintone\Api\ConnectionInterface
     */
    public $connection;
    /**
     * コンストラクタ
     * @param ConnectionInterface $connection Kintone API 接続器
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /* domain */
    // /**
    //  * id検索
    //  * @param  int|string  $id
    //  * @param  array|string  $columns
    //  * @return mixed|static
    //  */
    // public function find($id, $columns = ['*'])
    // {
    //     return $this->where('id', '=', $id)->first($columns);
    // }

    /**
     * 取得実行
     * @param  array|string  $columns 取得対象のカラム一覧 (デフォルト:指定なし = 全てのカラム)
     * @return \Illuminate\Support\Collection TODO:次考える
     */
    public function get($columns = [])
    {
        $items = collect($this->onceWithColumns(Arr::wrap($columns), function () {
            return $this->processor->processSelect($this, $this->runSelect());
        }));

        return $this->applyAfterQueryCallbacks(
            isset($this->groupLimit) ? $this->withoutGroupLimitKeys($items) : $items
        );
    }
}