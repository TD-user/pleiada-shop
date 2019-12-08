<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
            [['created_at', 'moderated_at'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['moderated_at'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID товару',
            'user_id' => 'ID користувача',
            'name' => 'Ім\'я',
            'text' => 'Відгук',
            'created_at' => 'Створено',
            'is_moderated' => 'Статус модерації',
            'moderator_id' => 'ID модератора',
            'moderated_at' => 'Дата модерації',
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
        else {
            $this->moderator_id = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert);
    }


}
