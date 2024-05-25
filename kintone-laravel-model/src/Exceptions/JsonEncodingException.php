<?php

namespace X48t96pa\Kintone\Exceptions;

use RuntimeException;

/**
 * JSON エンコードエラー
 * TODO: Illuminate\Database\Eloquent と同じにしているけど避けたい...
 */
class JsonEncodingException extends RuntimeException
{
    /**
     * Create a new JSON encoding exception for the model.
     *
     * @param  mixed  $model
     * @param  string  $message
     * @return static
     */
    public static function forModel($model, $message)
    {
        return new static('Error encoding model ['.get_class($model).'] with ID ['.$model->getKey().'] to JSON: '.$message);
    }
}
