<?php

use yii\db\Migration;

/**
 * Class m191207_180544_mainslider
 */
class m191207_180544_mainslider extends Migration
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
        $this->createTable('{{%mainslider}}',[
            'id' => $this->primaryKey(),
            'path' => $this->string(400)->notNull(),
            'title' => $this->string(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mainslider}}');

        echo "m191207_180544_mainslider cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_180544_mainslider cannot be reverted.\n";

        return false;
    }
    */
}
