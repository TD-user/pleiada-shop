<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%history}}".
 *
 * @property string|null $order
 * @property int $user_id
 * @property int $product_id
 * @property string|null $json
 * @property float $total
 * @property int $created_at
 *
 * @property Product $product
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%history}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'total', 'created_at'], 'required'],
            [['user_id', 'product_id', 'created_at'], 'integer'],
            [['total'], 'number'],
            [['order'], 'string', 'max' => 255],
            [['json'], 'string', 'max' => 5000],
            [['user_id', 'product_id'], 'unique', 'targetAttribute' => ['user_id', 'product_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order' => 'Order',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'json' => 'Json',
            'total' => 'Total',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
