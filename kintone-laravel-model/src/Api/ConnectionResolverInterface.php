<?php

namespace X48t96pa\Kintone\Api;

/**
 * Kintone API 接続器 決定のインターフェイス
 */
interface ConnectionResolverInterface
{
    /**
     * Kintone API 接続器の確立
     *
     * @param  string|null $name 接続設定情報 エイリアス
     * @return \X48t96pa\Kintone\Api\ConnectionInterface Kintone API 接続器
     */
    public function connection($name = null);

    // /**
    //  * Get the default connection name.
    //  *
    //  * @return string
    //  */
    // public function getDefaultConnection();

    // /**
    //  * Set the default connection name.
    //  *
    //  * @param  string  $name
    //  * @return void
    //  */
    // public function setDefaultConnection($name);
}
