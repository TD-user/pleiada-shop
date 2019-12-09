<?php

use yii\db\Migration;

/**
 * Class m191209_215729_order
 */
class m191209_215729_order extends Migration
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

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'user_id' => $this->integer(),
            'email' => $this->string(),
            'phone' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'total' => $this->double()->notNull(),
            'products_json' => $this->string(5000),
            'status' => $this->string(),
            'is_payment' => $this->integer(),
            'comment' => $this->string(5000),
            'methodPayment' => $this->string(),
            'methodDelivery' => $this->string(),
            'cost' => $this->double(),
            'payment' => $this->string()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');

        echo "m191209_215729_order cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191209_215729_order cannot be reverted.\n";

        return false;
    }
    */
}
