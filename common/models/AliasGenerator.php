<?php

namespace common\models;

class AliasGenerator
{
    public static function getAlias($ukrtext)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'h', 'ґ' => 'g',
            'д' => 'd', 'е' => 'e', 'є' => 'ie', 'ж' => 'zh', 'з' => 'z',
            'и' => 'y', 'і' => 'i', 'ї' => 'i', 'й' => 'i', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p',
            'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
            'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
            'ь' => '', 'ю' => 'iu', 'я' => 'ia',
            'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'h', 'Ґ' => 'g',
            'Д' => 'd', 'Е' => 'e', 'Є' => 'ye', 'Ж' => 'zh', 'З' => 'z',
            'И' => 'y', 'І' => 'i', 'Ї' => 'yi', 'Й' => 'y', 'К' => 'k',
            'Л' => 'l', 'М' => 'm', 'Н' => 'n', 'О' => 'o', 'П' => 'p',
            'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u', 'Ф' => 'f',
            'Х' => 'kh', 'Ц' => 'ts', 'Ч' => 'ch', 'Ш' => 'sh', 'Щ' => 'shch',
            'Ь' => '', 'Ю' => 'yu', 'Я' => 'ya',
        );

        $alias = strtr($ukrtext, $converter);

        $alias = strtolower($alias);

        $alias = preg_replace('~[^-a-z0-9_\/\:]+~u', '-', $alias);

        $alias = strtr($alias, ['/' => '-']);

        $alias = trim($alias, "-");

        return $alias;
    }
}