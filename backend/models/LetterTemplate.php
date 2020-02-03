<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%letter_template}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 */
class LetterTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%letter_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'body' => 'Шаблон',
        ];
    }
}
