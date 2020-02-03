<?php

use yii\db\Migration;

/**
 * Class m200203_215205_subscriber
 */
class m200203_215205_subscriber extends Migration
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

        $this->createTable('{{%subscriber}}',[
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscriber}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_215205_subscriber cannot be reverted.\n";

        return false;
    }
    */
}
