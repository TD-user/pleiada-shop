<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%subscriber}}".
 *
 * @property int $id
 * @property string $email
 * @property int|null $created_at
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscriber}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'trim'],
            [['email'], 'required', 'message' => 'Поле email не може бути порожнім'],
            [['email'], 'email', 'message' => 'Ви використали невалідний email'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => '\common\models\Subscriber', 'message' => 'Дякуємо, але такий email вже зареєстований в системі'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'created_at' => 'Дата підписки',
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
