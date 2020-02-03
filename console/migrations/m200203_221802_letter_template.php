<?php

use yii\db\Migration;

/**
 * Class m200203_221802_letter_template
 */
class m200203_221802_letter_template extends Migration
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

        $this->createTable('{{%letter_template}}',[
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%letter_template}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_221802_letter_template cannot be reverted.\n";

        return false;
    }
    */
}
