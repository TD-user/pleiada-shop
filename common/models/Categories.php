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

    public function getChilds()
    {
        $categories = Categories::find()->where(['id_parent' => $this->id])->all();
        return $categories;
    }

    public function getAllProducts($sort)
    {
        $products1      = null;
        $products2      = null;
        $sortType       = null;
        $categoriesArr  = [];

        switch ($sort) {
            case 1:
                $sortType = ['price' => SORT_DESC];
                break;
            case 2:
                $sortType = ['price' => SORT_ASC];
                break;
            case 3:
                $sortType = ['name' => SORT_ASC];
                break;
            case 4:
                $sortType = ['name' => SORT_DESC];
                break;
        }

        $categoriesArr[] = $this->id;

        if($this->hasChilds()) {
            $firstChilds = $this->getChilds();
            foreach ($firstChilds as $firstChild) {
                $categoriesArr[] = $firstChild->id;
                if($firstChild->hasChilds()) {
                    $secondChilds = $firstChild->getChilds();
                    foreach ($secondChilds as $secondChild) {
                        $categoriesArr[] = $secondChild->id;
                        if($secondChild->hasChilds()) {
                            $thirdChilds = $secondChild->getChilds();
                            foreach ($thirdChilds as $thirdChild) {
                                $categoriesArr[] = $thirdChild->id;
                            }
                        }
                    }
                }
            }
        }

        $products1 = Product::find()->where(['in', 'category_id', $categoriesArr])->andWhere(['>','remains',0])->orderBy($sortType)->asArray()->all();
        $products2 = Product::find()->where(['in', 'category_id', $categoriesArr])->andWhere(['remains' => 0])->orderBy($sortType)->asArray()->all();

        $products = array_merge($products1, $products2);

        return $products;
    }

    public function getAllProducts2($sort)
    {
        $products1 = null;
        $products2 = null;
        $sortType = null;

        switch ($sort) {
            case 1:
                $sortType = ['price' => SORT_DESC];
                break;
            case 2:
                $sortType = ['price' => SORT_ASC];
                break;
            case 3:
                $sortType = ['name' => SORT_ASC];
                break;
            case 4:
                $sortType = ['name' => SORT_DESC];
                break;
        }

        $products1 = $this->getProducts()->where(['>','remains',0])->orderBy($sortType)->asArray()->all();
        $products2 = $this->getProducts()->where(['remains' => 0])->orderBy($sortType)->asArray()->all();

        if($this->hasChilds()) {
            $firstChilds = $this->getChilds();

            foreach ($firstChilds as $firstChild) {
                $firstChildProduct1 = $firstChild->getProducts()->where(['>','remains',0])->orderBy($sortType)->asArray()->all();
                $firstChildProduct2 = $firstChild->getProducts()->where(['remains' => 0])->orderBy($sortType)->asArray()->all();

                $products1 = array_merge($products1, $firstChildProduct1);
                $products2 = array_merge($products2, $firstChildProduct2);

                if($firstChild->hasChilds()) {
                    $secondChilds = $firstChild->getChilds();

                    foreach ($secondChilds as $secondChild) {
                        $secondChildProduct1 = $secondChild->getProducts()->where(['>','remains',0])->orderBy($sortType)->asArray()->all();
                        $secondChildProduct2 = $secondChild->getProducts()->where(['remains' => 0])->orderBy($sortType)->asArray()->all();

                        $products1 = array_merge($products1, $secondChildProduct1);
                        $products2 = array_merge($products2, $secondChildProduct2);

                        if($secondChild->hasChilds()) {
                            $thirdChilds = $secondChild->getChilds();

                            foreach ($thirdChilds as $thirdChild) {
                                $thirdChildProduct1 = $thirdChild->getProducts()->where(['>','remains',0])->orderBy($sortType)->asArray()->all();
                                $thirdChildProduct2 = $thirdChild->getProducts()->where(['remains' => 0])->orderBy($sortType)->asArray()->all();

                                $products1 = array_merge($products1, $thirdChildProduct1);
                                $products2 = array_merge($products2, $thirdChildProduct2);
                            }
                        }
                    }
                }
            }
        }

        $products = array_merge($products1, $products2);

        return $products;
    }

    public function getSingleProducts($sort)
    {
        $products1      = null;
        $products2      = null;
        $sortType       = null;

        switch ($sort) {
            case 1:
                $sortType = ['price' => SORT_DESC];
                break;
            case 2:
                $sortType = ['price' => SORT_ASC];
                break;
            case 3:
                $sortType = ['name' => SORT_ASC];
                break;
            case 4:
                $sortType = ['name' => SORT_DESC];
                break;
        }

        $products1 = $this->getProducts()->where(['>','remains',0])->orderBy($sortType)->asArray()->all();
        $products2 = $this->getProducts()->where(['remains' => 0])->orderBy($sortType)->asArray()->all();

        $products = array_merge($products1, $products2);

        return $products;
    }

}
