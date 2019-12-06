<?php

namespace common\models;

use Yii;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $code_1c
 * @property int $parent_code_1c
 * @property string $name
 * @property double $price
 * @property double $promotionPrice
 * @property string $currency
 * @property int $remains
 * @property string $unit
 * @property string $article
 * @property string $manufacturer
 * @property string $description
 * @property string $alias
 *
 * @property Cart[] $carts
 * @property User[] $usersCarts
 * @property Favourite[] $favourites
 * @property User[] $usersFavourites
 * @property History[] $histories
 * @property User[] $usersHistory
 * @property Images[] $images
 * @property Categories $category
 * @property Reviews[] $reviews
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'price', 'remains'], 'required'],
            [['category_id', 'code_1c', 'parent_code_1c', 'remains'], 'integer'],
            [['price', 'promotionPrice'], 'number'],
            [['name'], 'string', 'max' => 400],
            [['currency', 'unit', 'article', 'manufacturer', 'description', 'alias'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'code_1c' => 'Code 1c',
            'parent_code_1c' => 'Parent Code 1c',
            'name' => 'Name',
            'price' => 'Price',
            'promotionPrice' => 'Promotion Price',
            'currency' => 'Currency',
            'remains' => 'Remains',
            'unit' => 'Unit',
            'article' => 'Article',
            'manufacturer' => 'Manufacturer',
            'description' => 'Description',
            'alias' => 'Alias',
        ];
    }

    public function beforeSave($insert)
    {
        $this->alias = AliasGenerator::getAlias($this->name);
        return parent::beforeSave($insert);
    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//        if($insert) {
//            $product = Product::findOne(Yii::$app->db->getLastInsertID());
//            $product->alias = AliasGenerator::getAlias($product->name);
//            $product->alias = $product->alias . '-' . $product->id;
//            $product->save();
//        }
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersCarts()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%cart}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourite::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFavourites()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%favourite}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersHistory()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%history}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['product_id' => 'id']);
    }

    public function isProductFavouriteToUser($userId) {
        if(isset($this->id) and isset($userId)) {
            $count = Favourite::find()->where(['product_id' => $this->id, 'user_id' => $userId])->count();
            if($count > 0) {
                return true;
            }
            return false;
        }
        return false;
    }
}
