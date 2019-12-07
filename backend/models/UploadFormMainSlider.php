<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 07.12.2019
 * Time: 20:54
 */

namespace backend\models;


use common\models\Mainslider;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormMainSlider extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public $image;

    public function rules()
    {
        return [
            [['imageFile'], 'safe'],
        ];
    }

    public function upload()
    {
        if($this -> validate()) {
            if (!file_exists(Yii::getAlias('@frontend') . '/web/img/mainslider'))
                mkdir(Yii::getAlias('@frontend') . '/web/img/mainslider', 0777);

            foreach ($this->imageFile as $key => $value) {
                if (!file_exists(Yii::getAlias('@frontend') . '/web/img/mainslider/' . $value->name)) {
                    $value->saveAs(Yii::getAlias('@frontend') . '/web/img/mainslider/' . $value->name);
                    $this->image->path = '/img/mainslider/' . $value->name;
                    $this->image->save();
                } else {
                    return false;
                }

            }
            return true;
        }
        return false;
    }
}