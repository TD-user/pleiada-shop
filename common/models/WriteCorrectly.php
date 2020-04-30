<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 01.12.2019
 * Time: 19:31
 */

namespace common\models;


class WriteCorrectly
{
    public static function corecllyReviews($number){
        $keys = array(2, 0, 1, 1, 1, 2);
        $review = array('відгук', 'відгуки', 'відгуків');
        $mod = $number % 100;
        $variant = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];

        return $review[$variant];
    }

    public static function corecllyResults($number){
        $keys = array(2, 0, 1, 1, 1, 2);
        $review = array('товар', 'товари', 'товарів');
        $mod = $number % 100;
        $variant = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)];

        return $review[$variant];
    }

    public static function mb_ucfirst($text) {
        mb_internal_encoding("UTF-8");
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_strtolower(mb_substr($text, 1));
    }

}