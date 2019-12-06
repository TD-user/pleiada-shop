<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property string $title
 *
 * @property Product $product
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'path'], 'required'],
            [['product_id'], 'integer'],
            [['path'], 'string', 'max' => 400],
            [['title'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'path' => 'Path',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function beforeDelete()
    {
        DeleteImage::deleteImg(Yii::getAlias('@frontend').'/web'.$this->path);
        return parent::beforeDelete();
    }


}
