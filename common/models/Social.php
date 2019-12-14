<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%social}}".
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $name
 * @property string|null $href
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%social}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'string', 'max' => 400],
            [['name', 'href'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'name' => 'Назва',
            'href' => 'Посилання',
        ];
    }

    public static function getFilledSocial()
    {
        $socials = self::find()->where(['not', ['href' => '']])->andWhere(['not', ['href' => null]])->all();
        return $socials;
    }
}
