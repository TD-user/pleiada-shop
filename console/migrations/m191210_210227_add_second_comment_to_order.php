<?php

use yii\db\Migration;

/**
 * Class m191210_210227_add_second_comment_to_order
 */
class m191210_210227_add_second_comment_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'comment_admin', $this->string(5000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'comment_admin');

        echo "m191210_210227_add_second_comment_to_order cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191210_210227_add_second_comment_to_order cannot be reverted.\n";

        return false;
    }
    */
}
