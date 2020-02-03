<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%letter}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property int|null $created_at
 * @property int|null $admin_id
 * @property int|null $status
 *
 * @property Admin $admin
 */
class Letter extends \yii\db\ActiveRecord
{
    const CREATED = 1;
    const SENDED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%letter}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['created_at', 'admin_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'body' => 'Текст',
            'created_at' => 'Дата створення',
            'admin_id' => 'Адміністратор',
            'status' => 'Статус',
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

    public function beforeSave($insert)
    {
        if($insert) {
            $this->status = self::CREATED;
            $this->admin_id = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setFrom(['td87td87@gmail.com' => 'Магазин Плеяда'])
            ->setTo($email)
            ->setSubject($this->title)
            ->setHtmlBody($this->body)
            ->send();
    }
}
