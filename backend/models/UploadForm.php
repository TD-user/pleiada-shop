<?php
/**
 * Created by PhpStorm.
 * User: td779
 * Date: 04.12.2019
 * Time: 20:14
 */

namespace backend\models;

use common\models\Images;
use common\models\Product;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public $product;

    public function rules()
    {
        return [
            [['imageFile'], 'safe'],
        ];
    }

    public function upload()
    {
        if($this -> validate()) {
            if (!file_exists(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web'. DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $this->product->id))
                mkdir(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $this->product->id, 0777);

            foreach ($this->imageFile as $key => $value) {
                $image = new Images();
                $image->product_id = $this->product->id;

                if (!file_exists(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $this->product->id . DIRECTORY_SEPARATOR . $value->name)) {
                    $value->saveAs(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR . $this->product->id . DIRECTORY_SEPARATOR . $value->name);
                    $image->path = '/img/products/' . $this->product->id . '/' . $value->name;
                    $image->title = $value->name;
                    $image->save();
                }
            }
            return true;
        }
        return false;
    }
}