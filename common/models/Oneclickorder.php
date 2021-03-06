<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%oneclickorder}}".
 *
 * @property int $id
 * @property int|null $created_at
 * @property string $phone
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $email
 * @property string|null $address
 * @property float $total
 * @property string|null $products_json
 * @property int|null $status
 * @property int|null $is_payment
 * @property string|null $comment
 */
class Oneclickorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%oneclickorder}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'status', 'is_payment'], 'integer'],
            [['phone', 'total'], 'required'],
            [['total'], 'number'],
            ['total', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            [['phone', 'name', 'surname', 'email', 'address'], 'string', 'max' => 255],
            [['products_json', 'comment'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата створення',
            'phone' => 'Телефон',
            'name' => 'Ім\'я',
            'surname' => 'Прізвище',
            'email' => 'Email',
            'address' => 'Адреса',
            'total' => 'Сума',
            'products_json' => 'Products Json',
            'status' => 'Статус',
            'is_payment' => 'Оплата',
            'comment' => 'Примітки',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }
}
