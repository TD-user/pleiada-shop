<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 06.12.2019
 * Time: 22:51
 */

namespace common\models;


class DeleteImage
{
    public static function deleteImg ($path)
    {
        if (file_exists($path))
            return unlink($path);
        return false;
    }

    public static function deleteFolder ($path)
    {
        if (!file_exists($path)) {
            return true;
        }

        if (!is_dir($path)) {
            return unlink($path);
        }

        foreach (scandir($path) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!self::deleteFolder($path . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($path);
    }
}