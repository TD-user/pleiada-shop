<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%mainslider}}".
 *
 * @property int $id
 * @property string $path
 * @property string|null $title
 */
class Mainslider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mainslider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['path'], 'string', 'max' => 400],
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
            'path' => 'Path',
            'title' => 'Title',
        ];
    }

    public function beforeDelete()
    {
        DeleteImage::deleteImg(Yii::getAlias('@frontend').'/web'.$this->path);
        return parent::beforeDelete();
    }


}
