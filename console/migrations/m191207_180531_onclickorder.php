<?php

use yii\db\Migration;

/**
 * Class m191207_180531_onclickorder
 */
class m191207_180531_onclickorder extends Migration
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

        $this->createTable('{{%oneclickorder}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'phone' => $this->string()->notNull(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'total' => $this->double()->notNull(),
            'products_json' => $this->string(5000),
            'status' => $this->integer(),
            'is_payment' => $this->integer(),
            'comment' => $this->string(5000),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%oneclickorder}}');

        echo "m191207_180531_onclickorder cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_180531_onclickorder cannot be reverted.\n";

        return false;
    }
    */
}
