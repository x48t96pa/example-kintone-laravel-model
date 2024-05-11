<?php

namespace X48t96pa\Kintone\Models;
// abstract model

class KintoneModel
{
    /**
     * コンストラクタ
     * @param array $attributes 
     * @return void
     */
    public function __construct(array $attributes = [])
    {
    }

    public function test(): string
    {
        return 'Hello Composer World!!!!';
    }
}