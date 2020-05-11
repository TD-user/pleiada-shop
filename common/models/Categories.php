<?php

namespace common\models;

use Yii;
use common\models\AliasGenerator;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $id
 * @property int $id_parent
 * @property string $name
 * @property string $img_url
 * @property string $alias
 * @property string $code_1c
 *
 * @property Product[] $products
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent', 'name'], 'required'],
            [['id_parent'], 'integer'],
            [['name', 'img_url', 'alias'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Батьківське Id',
            'name' => 'Назва',
            'img_url' => 'Зображення',
            'alias' => 'seo url',
            'code_1c' => 'Код 1с',
        ];
    }

    public function beforeSave($insert)
    {
        $this->alias = AliasGenerator::getAlias($this->name);
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        if($this->id_parent == 0)
            DeleteImage::deleteFolder(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR . $this->id);
        return parent::beforeDelete();
    }

    protected function updateSeparator()
    {
        $path = $this->img_url;
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        return $path;
    }

    public function deleteImg()
    {
        if($this->id_parent == 0)
            DeleteImage::deleteImg(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . $this->updateSeparator());
        return true;
    }

    public static function getTreeMenuArray()
    {
        $categories = self::find()->asArray()->all();
        $cats = array();
        foreach ($categories as $category) {
            if($category['id_parent'] != -1)
                $cats[$category['id']] = $category;
        }
        $tree = array();
        foreach ($cats as $id => &$node) {
            if (!$node['id_parent']){
                $tree[$id] = &$node;
            }else{
                $cats[$node['id_parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function hasChilds()
    {
        $categor = Categories::findOne(['id_parent' => $this->id]);
        if ($categor == null)
            return false;
        return true;
    }

    public function getTree()
    {
        $categor = Categories::find()->where(['id_parent' => $this->id])->asArray()->all();
        $cat = array();
        foreach ($categor as $value)
        {
            $cat[$value['id']] = $value;
            $subcategor = Categories::find()->where(['id_parent' => $value['id']])->asArray()->all();
            foreach ($subcategor as $item)
            {
                $cat[$value['id']]['childs'][$item['id']] = $item;
            }
        }
        return $cat;
    }

}
