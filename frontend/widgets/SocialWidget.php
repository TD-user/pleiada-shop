<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 12.12.2019
 * Time: 20:23
 */

namespace frontend\widgets;

use yii\base\Widget;
use common\models\Social;

class SocialWidget extends Widget
{
    public $data;

    public function init()
    {
        $this->data = Social::getFilledSocial();
    }

    public function run()
    {
        return $this->dataToTemplate($this->data);
    }

    public function dataToTemplate($data)
    {
        ob_start();
        include __DIR__.'/template/socials.php';
        return ob_get_clean();
    }
}