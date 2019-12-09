<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%np_cities}}".
 *
 * @property int $id
 * @property string|null $Description
 * @property string|null $Ref
 * @property string|null $CityID
 */
class NpCities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%np_cities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'Ref', 'CityID'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Description' => 'Description',
            'Ref' => 'Ref',
            'CityID' => 'City ID',
        ];
    }
}
