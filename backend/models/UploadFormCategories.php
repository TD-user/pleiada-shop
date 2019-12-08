<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 08.12.2019
 * Time: 13:07
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormCategories extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public $category;

    public function rules()
    {
        return [
            [['imageFile'], 'safe'],
        ];
    }

    public function upload()
    {
        if($this -> validate()) {
            if (!file_exists(Yii::getAlias('@frontend') . '/web/img/categories/' . $this->category->id))
                mkdir(Yii::getAlias('@frontend') . '/web/img/categories/' . $this->category->id, 0777);

            foreach ($this->imageFile as $key => $value) {
                if (!file_exists(Yii::getAlias('@frontend') . '/web/img/categories/' . $this->category->id . '/' . $value->name)) {
                    $value->saveAs(Yii::getAlias('@frontend') . '/web/img/categories/' . $this->category->id . '/' . $value->name);
                    $this->category->img_url = '/img/categories/' . $this->category->id . '/' . $value->name;
                    $this->category->save();
                } else {
                    return false;
                }

            }
            return true;
        }
        return false;
    }
}