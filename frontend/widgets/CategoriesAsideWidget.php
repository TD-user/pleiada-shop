<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 26.11.2019
 * Time: 13:39
 */

namespace frontend\widgets;

use common\models\Categories;
use yii\base\Widget;

class CategoriesAsideWidget extends Widget
{
    public $data;

    public function init()
    {
        $this->data = Categories::getTreeMenuArray();
    }

    public function run()
    {
        return $this->dataToTemplate($this->data);
    }

    public function dataToTemplate($data)
    {
        ob_start();
        include __DIR__.'/template/categoriesAside.php';
        return ob_get_clean();
    }
}