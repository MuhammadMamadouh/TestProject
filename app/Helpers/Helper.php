<?php
namespace App\Helpers;

class Helper
{

/**
 * General inputs which used in Edit-create Form
 * Like
 * <input type="text|file|color|..etc"
 *
 * @return string[]
 */
    public static function generalInputs(): array
    {
        return [
            'text', 'file', 'date', 'color', 'email', 'password', 'number',
        ];
    }

}
