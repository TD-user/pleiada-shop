<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.11.2019
 * Time: 1:30
 */

namespace backend\models;

use common\models\Product;


class XmlToDB extends \yii\base\Model
{
    public $path;

    public function rules()
    {
        return ([
            [['path'],'required'],
        ]);
    }

    public function getArrayByXML()
    {

        if (file_exists($this->path)) {
            $xml = simplexml_load_file($this->path);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);
            $this->path=null;
            return $array;

        } else {
           return false;
        }
    }
    public function addProduct($category_id,$name,$price,$remains,$code_1c,$parent_code_1c,$promotionPrice,$currency,$unit,$article,$manufacturer,$description,$alias)
    {
        $product = new Product();
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
    public function ArrayToDB()
    {
        if (is_array($array=$this->getArrayByXML())) {
            $array = $array['item'];

            $counter = 0;

            $categories = array(2,3,4,5,6,7,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,28,29,30,31,32,33,34,35,36,37,39,40,41,42,43);

            foreach ($array as $item => $value)
            {
                $this->addProduct(
                    array_rand($categories,1),
                    $value['Name'],
                    floatval(str_replace (',','.',$value['Price'])),
                    (int)$value['Remains'],
                    (int)$value['Code'],
                    (int)$value['ParentCode'],
                    floatval(str_replace (',','.',$value['PromotionPrice'])),
                    $value['Сurrency'],
                    $value['Unit'],
                    null,
                    null,
                    null,
                    null
                );
                $counter++;
                if($counter == 1) return true;
            }
            return true;
        }
        return false;
    }
}