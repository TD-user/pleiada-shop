<?php

use yii\db\Migration;

/**
 * Class m200203_221740_letter
 */
class m200203_221740_letter extends Migration
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

        $this->createTable('{{%letter}}',[
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'created_at' => $this->integer(),
            'admin_id' => $this->integer(11),
            'status' => $this->integer(),
        ],$tableOptions);

        $this->createIndex('idx-letter-admin_id', '{{%letter}}', 'admin_id');

        $this->addForeignKey('fk-letter-admin_id',
            '{{%letter}}',
            'admin_id',
            '{{%admin}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-letter-admin_id', '{{%letter}}');
        $this->dropForeignKey('fk-letter-admin_id', '{{%letter}}');
        $this->dropTable('{{%letter}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_221740_letter cannot be reverted.\n";

        return false;
    }
    */
}
