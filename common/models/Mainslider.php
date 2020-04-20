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

    protected function updateSeparator()
    {
        $path = $this->path;
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        return $path;
    }

    public function beforeDelete()
    {
        DeleteImage::deleteImg(Yii::getAlias('@www') . DIRECTORY_SEPARATOR . 'web' . $this->updateSeparator());
        return parent::beforeDelete();
    }


}
