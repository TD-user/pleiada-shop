<?php

use yii\db\Migration;

/**
 * Class m191201_141728_history
 */
class m191201_141728_history extends Migration
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
            'order'=>$this->string(),
            'user_id'=>$this->integer(11),
            'product_id'=>$this->integer(11),
            'json'=>$this->string(5000),
            'total' => $this->double()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'PRIMARY KEY(user_id, product_id)'
        ], $tableOptions);

        $this->createIndex('idx-history-user_id', '{{%history}}', 'user_id');

        $this->addForeignKey('fk-history-user_id',
            '{{%history}}',
            'user_id',
            '{{%user}}',
            'id',
            'NO ACTION'
        );

        $this->createIndex('idx-history-product_id', '{{%history}}', 'product_id');

        $this->addForeignKey('fk-history-product_id',
            '{{%history}}',
            'product_id',
            '{{%product}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');

        $this->dropIndex('idx-history-user_id', '{{%history}}');
        $this->dropForeignKey('fk-history-user_id', '{{%history}}');
        $this->dropIndex('idx-history-product_id', '{{%history}}');
        $this->dropForeignKey('fk-history-product_id', '{{%history}}');

        echo "m191201_141728_history cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_141728_history cannot be reverted.\n";

        return false;
    }
    */
}
