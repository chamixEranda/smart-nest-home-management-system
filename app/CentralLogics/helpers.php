<?php
namespace App\CentralLogics;

class Helpers
{
    public static function default_lang()
    {
        return 'en';
    }
    
    public static function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }
}