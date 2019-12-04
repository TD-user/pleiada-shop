<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $name
 * @property string $text
 * @property int $created_at
 * @property int $is_moderated
 * @property int $moderator_id
 * @property int $moderated_at
 *
 * @property Product $product
 * @property User $user
 */
class Reviews extends \yii\db\ActiveRecord
{

    const NOT_MODERATED = 0;
    const MODERATED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'created_at', 'is_moderated', 'moderator_id', 'moderated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'required', 'message' => 'Поле не може бути порожнім'],
            [['text'], 'string', 'max' => 5000],
            [['text'], 'required', 'message' => 'Поле не може бути порожнім'],
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
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'text' => 'Text',
            'created_at' => 'Created At',
            'is_moderated' => 'Is Moderated',
            'moderator_id' => 'Moderator ID',
            'moderated_at' => 'Moderated At',
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

    public function beforeSave($insert)
    {
        if($insert) {
            $this->is_moderated = self::NOT_MODERATED;
        }
        return parent::beforeSave($insert);
    }


}
