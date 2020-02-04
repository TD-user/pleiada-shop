<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.11.2019
 * Time: 1:30
 */

namespace backend\models;

use common\models\Categories;
use Yii;
use yii\db\Exception;
use yii\db\Query;
use yii\web\Application;


class XmlCategory extends \yii\base\Model
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
    public function addCategory($name,$parent_id,$code)
    {
        $category = new Categories();
        $category->id_parent=$parent_id;
        $category->name=$name;
        $category->code_1c = $code;
        return $category->save();
    }

    public function ArrayToDB()
    {

        if (is_array($array=$this->getArrayByXML())) {
            $array = $array['Category'];


            $array_p=[];
            $array_c=[];
            foreach ($array as $item => $value)
            {

                if($value['ParentCode'] == null)
                {
                  array_push($array_p,$value);
                  $this->addCategory($value['Name'],0,$value['Code']);
                }
                array_push($array_c,$value);
            }

            foreach ($array_c as $item => $value)
            {

                $query = new Query();
                $query  ->select(['id'])
                    ->from('categories')
                    ->where(['code_1c'=>(int)$value['ParentCode']]);
                $command = $query->createCommand();
                try {
                    $data = $command->queryAll();
                    $this->addCategory($value['Name'],$data[0]['id'],$value['Code']);
                } catch (Exception $e) {
                }

            }


            return true;
        }

        return false;
    }
}