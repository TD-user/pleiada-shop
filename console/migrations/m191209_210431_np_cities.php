<?php

use yii\db\Migration;

/**
 * Class m191209_210431_np_cities
 */
class m191209_210431_np_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=INNODB';
        }
        $this->createTable('{{%np_cities}}',[
            'id' => $this->primaryKey(),
            'Description' => $this->string(),
            'Ref' => $this->string(),
            'CityID' => $this->string(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%np_cities}}');

        echo "m191209_210431_np_cities cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191209_210431_np_cities cannot be reverted.\n";

        return false;
    }
    */
}
