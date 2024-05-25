<?php

namespace X48t96pa\Kintone\Api;

/**
 * Kintone API 接続器確立 クラス
 * TODO: \Illuminate\Database\DatabaseManager の役割の方が正しいのかと思われる？ あくまでも DatabaseManagerとかを呼び出すやつっぽい
 */
class ConnectionResolver implements ConnectionResolverInterface
{

    /**
     * コンストラクタ
     * @param  array<string, \X48t96pa\Kintone\Api\ConnectionInterface>  $connections Kintone API 接続器確立 クラスの一覧 TODO:複数個のKintoneに接続するよう
     * @return void
     */
    public function __construct(array $connections = [])
    {
        // TODO:まずは単一のKintoneに接続を確立するところから
        // foreach ($connections as $name => $connection) {
        //     $this->addConnection($name, $connection);
        // }
    }

    /**
     * Kintone API 接続器の確立
     * @param  string|null $name 接続設定情報 エイリアス
     * @return \X48t96pa\Kintone\Api\ConnectionInterface Kintone API 接続器
     */
    public function connection($name = null)
    {

    }
}