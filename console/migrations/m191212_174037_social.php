<?php

use yii\db\Migration;

/**
 * Class m191212_174037_social
 */
class m191212_174037_social extends Migration
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
        $this->createTable('{{%social}}',[
            'id' => $this->primaryKey(),
            'path' => $this->string(400),
            'name' => $this->string(),
            'href' => $this->string(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social}}');

        echo "m191212_174037_social cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191212_174037_social cannot be reverted.\n";

        return false;
    }
    */
}
