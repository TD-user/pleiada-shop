<?php

use yii\db\Migration;

/**
 * Class m191123_215633_htmlpages
 */
class m191123_215633_htmlpages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%htmlpages}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'alias' => $this->string(),
            'text' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%htmlpages}}');

        echo "m191123_215633_htmlpages cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191123_215633_htmlpages cannot be reverted.\n";

        return false;
    }
    */
}
