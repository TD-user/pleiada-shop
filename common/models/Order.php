<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property int|null $created_at
 * @property int|null $user_id
 * @property string|null $email
 * @property string $phone
 * @property string $name
 * @property string $surname
 * @property string $address
 * @property float $total
 * @property string|null $products_json
 * @property string|null $status
 * @property int|null $is_payment
 * @property string|null $comment
 * @property string|null $comment_admin
 * @property string|null $methodPayment
 * @property string|null $methodDelivery
 * @property float|null $cost
 * @property string|null $payment
 */
class Order extends \yii\db\ActiveRecord implements \borysenko\liqpay\interfaces\Order
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'user_id', 'is_payment'], 'integer'],
            [['phone', 'name', 'surname', 'address', 'total'], 'required'],
            [['total', 'cost'], 'number'],
            [['email', 'phone', 'name', 'surname', 'address', 'status', 'methodPayment', 'methodDelivery', 'payment'], 'string', 'max' => 255],
            [['products_json', 'comment', 'comment_admin'], 'string', 'max' => 5000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата замовлення',
            'user_id' => 'User ID',
            'email' => 'Email',
            'phone' => 'Телефон',
            'name' => 'Ім\'я',
            'surname' => 'Прізвище',
            'address' => 'Місце доставки',
            'total' => 'Сума',
            'products_json' => 'Products Json',
            'status' => 'Статус',
            'is_payment' => 'Is Payment',
            'comment' => 'Коментар',
            'comment_admin' => 'Коментар адміністратора',
            'methodPayment' => 'Метод оплати',
            'methodDelivery' => 'Метод доставки',
            'cost' => 'Cost',
            'payment' => 'Payment',
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

    public function getId()
    {
        return $this->id;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setPaymentStatus($status)
    {
        $this->payment = $status;

        return $this;
    }
}
