<?php

use yii\db\Migration;

/**
 * Class m191201_142022_cart
 */
class m191201_142022_cart extends Migration
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

        $this->createTable('{{%cart}}', [
            'user_id'=>$this->integer(11),
            'product_id'=>$this->integer(11),
            'count'=>$this->integer()->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY(user_id, product_id)'
        ], $tableOptions);

        $this->createIndex('idx-cart-user_id', '{{%cart}}', 'user_id');

        $this->addForeignKey('fk-cart-user_id',
            '{{%cart}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-cart-product_id', '{{%cart}}', 'product_id');

        $this->addForeignKey('fk-cart-product_id',
            '{{%cart}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');

        $this->dropIndex('idx-cart-user_id', '{{%cart}}');
        $this->dropForeignKey('fk-cart-user_id', '{{%cart}}');
        $this->dropIndex('idx-cart-product_id', '{{%cart}}');
        $this->dropForeignKey('fk-cart-product_id', '{{%cart}}');

        echo "m191201_142022_cart cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_142022_cart cannot be reverted.\n";

        return false;
    }
    */
}
