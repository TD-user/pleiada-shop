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
        $this->createIndex('idx-order-user_id', '{{%order}}', 'user_id');

        $this->addForeignKey('fk-order-user_id',
            '{{%order}}',
            'user_id',
            '{{%user}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-order-user_id', '{{%history}}');
        $this->dropForeignKey('fk-order-user_id', '{{%history}}');

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
