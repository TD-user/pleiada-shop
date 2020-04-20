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

    public static function getTreeMenuArray()
    {
        $categories = self::find()->asArray()->all();
        $cats = array();
        foreach ($categories as $category) {
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

}
