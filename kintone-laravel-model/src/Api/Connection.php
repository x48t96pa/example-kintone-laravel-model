<?php

namespace X48t96pa\Kintone\Api;

use X48t96pa\Kintone\Query\KintoneAPIBuilder as QueryBuilder;

/**
 * Kintone API 接続器 実装クラス
 */
class Connection implements ConnectionInterface
{
    /**
     * Kintone API クエリビルダーの生成
     * @return \X48t96pa\Kintone\Query\KintoneAPIBuilder
     */
    public function query()
    {
        return new QueryBuilder(
            $this, // DB接続情報 (hostとか)
            // $this->getQueryGrammar(), // whereNotNull() -> where句 is not nullとか部分を作る 文法クエリ生成器 TODO: ここは目指していきたい
            // $this->getPostProcessor() // processInsertGetId() -> insert into 結果 のPKのIDを返却させるようにするとかの 返却の形変換系をやっているっぽいやつ TODO:　ここもできたらいきたい
        );
    }
}