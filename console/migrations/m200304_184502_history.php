<?php

use yii\db\Migration;

/**
 * Class m200304_184502_history
 */
class m200304_184502_history extends Migration
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

        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(11),
            'product_id'=>$this->integer(11),
            'count'=>$this->integer(),
            'created_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200304_184502_history cannot be reverted.\n";

        return false;
    }
    */
}
