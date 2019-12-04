<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191123_212601_categories
 */
class m191123_212601_categories extends Migration
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
        $this->createTable('{{%categories}}',[
            'id' => Schema::TYPE_PK,
            'id_parent' => $this->integer()->notNull(),
            'name' => $this->string()->notNull()->unique(),
            'img_url' => $this->string()->null(),
            'alias' =>$this->string()->null()
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');

        echo "m191123_212601_categories cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191122_190430_categories cannot be reverted.\n";

        return false;
    }
    */
}
