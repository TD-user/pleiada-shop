<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.11.2019
 * Time: 1:30
 */

namespace backend\models;

use common\models\Images;
use common\models\Product;
use Yii;
use yii\db\Exception;
use yii\db\Query;
use yii\web\Application;


class XmlToDB extends \yii\base\Model
{
    public $path;

    public function rules()
    {
        return [
            [['path'],'validateFile' ],
            [['path'],'required','skipOnEmpty' => false, 'message'=>'Виберіть файл']
        ];
    }

    public function validateFile()
    {


        if ($this->path->extension !== 'xml') {
            $this->addError('path', 'Файл повинен мати розширення xml');
        }
    }
    public function getArrayByXML()
    {
        if ($this->validate()) {
            try {

            $this->path->saveAs(\Yii::getAlias('@backend') . $this->path->baseName . '.' . $this->path->extension);
            $path = \Yii::getAlias('@backend') . $this->path->baseName . '.' . $this->path->extension;
            if (file_exists($path)) {
                $file = file_get_contents($path);
                $str = str_replace('&', '&#38;', $file, $count);
                file_put_contents($path, $str);
                $xml = simplexml_load_file($path);
                $json = json_encode($xml);
                $array = json_decode($json, TRUE);
                $this->path = null;
                unlink($path);

                return $array;
            } else {
                return false;

            }
            }catch (\Exception $e)
            {
               return false;
            }
        }
        return false;

    }
    public function addProduct($id,$category_id,$name,$price,$remains,$code_1c,$parent_code_1c,$promotionPrice,$currency,$unit,$article,$manufacturer,$description,$alias)
    {
        if ($id === NULL)
            $product = new Product();
        else
            $product = Product::findOne($id);

        $product->category_id=(int)$category_id;
        $product->code_1c=$code_1c;
        $product->parent_code_1c=$parent_code_1c;
        $product->name=$name;
        $product->price=$price;
        $product->promotionPrice=$promotionPrice;
        $product->currency=$currency;
        $product->remains=$remains;
        $product->unit=$unit;
        $product->article=$article;
        $product->manufacturer=$manufacturer;
        $product->description=$description;
        $product->alias=$alias;
        return $product->save();
    }

    public  function  getId($a)
    {
        $query = new Query();
        $query->select(['id'])
            ->from('product')
            ->where(['code_1c' => (int)$a]);
        $command = $query->createCommand();
        $data = $command->queryAll();
        if (!empty($data)) {
            $id = $data[0]['id'];
            return $id;
        }
        return null;
    }
    public  function getIdCategory($pc){
        $query = new Query();
        $query->select(['id'])
            ->from('categories')
            ->where(['code_1c' => (int)$pc]);
            $command = $query->createCommand();
          $data= $command->queryAll();
        return $data[0]['id'];
    }

    public function getPromoPrice($id,$value)
    {
        if ($id != null)
        {
            $query = new Query();
            $query->select(['promotionPrice'])
                ->from('product')
                ->where(['id' => (int)$id]);
            $command = $query->createCommand();
            $data= $command->queryAll();
            return $data[0]['promotionPrice'];
        }
return floatval(str_replace (',','.',$value));

}

public function ArrayToDB()
{

    if (is_array($array=$this->getArrayByXML())) {
        $array = $array['item'];
//        $counter = 0;


        foreach ($array as $item => $value)
        {
            $this->addProduct(
                $id = $this->getId($value['Code']),
                $this->getIdCategory($value['ParentCode']),
                $value['Name'],
                floatval(str_replace (',','.',$value['Price'])),
                (int)$value['Remains'],
                (int)$value['Code'],
                (int)$value['ParentCode'],
                $this->getPromoPrice($id,$value['PromotionPrice']),
                $value['Сurrency'],
                $value['Unit'],
                null,
                null,
                null,
                null
            );

//            $counter++;
//            if($counter == 1) return true;
        }

        return true;
    }

    return false;
}

    public function addImg ($product,$path,$title)
    {
        $img = new Images();
        $img->product_id=$product;
        $img->path=$path;
        $img->title=$title;
        return $img->save();

    }
    public  function getImg($pc){
        $query = new Query();
        $query->select(['id'])
            ->from('images')
            ->where(['title' => $pc]);
        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data[0]['id'];
    }
    public  function  setImgToDb ()
    {

        $dir=Yii::getAlias('@frontend').'/web/img/products';
        $arr = scandir($dir);
        foreach ($arr as $value) {
            if($this->getImg($value) == null ) {
                if (($id = $this->getId((int)$value)) != null && strpos($value, '.')) {
                    $this->addImg(
                        $id,
                        '/img/products/' . $value,
                        $value);
                }
            }
        }
        return true;
    }
}