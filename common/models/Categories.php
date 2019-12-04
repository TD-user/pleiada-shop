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
            'id_parent' => 'Id Parent',
            'name' => 'Name',
            'img_url' => 'Img Url',
            'alias' => 'Alias',
        ];
    }

    public function beforeSave($insert)
    {
        $this->alias = AliasGenerator::getAlias($this->name);
        return parent::beforeSave($insert);
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
