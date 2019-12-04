<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%htmlpages}}".
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $text
 */
class Htmlpages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%htmlpages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'text' => 'Text',
        ];
    }

    public function beforeSave($insert)
    {
        if(empty($this->alias)) {
            $this->alias = AliasGenerator::getAlias($this->title);
        }
        return parent::beforeSave($insert);
    }


}
