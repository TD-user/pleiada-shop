<?php

use yii\db\Migration;

/**
 * Class m191201_135819_favourite
 */
class m191201_135819_favourite extends Migration
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

        $this->createTable('{{%favourite}}', [
            'user_id'=>$this->integer(11),
            'product_id'=>$this->integer(11),
            'PRIMARY KEY(user_id, product_id)'
        ], $tableOptions);

        $this->createIndex('idx-favourite-user_id', '{{%favourite}}', 'user_id');

        $this->addForeignKey('fk-favourite-user_id',
            '{{%favourite}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-favourite-product_id', '{{%favourite}}', 'product_id');

        $this->addForeignKey('fk-favourite-product_id',
            '{{%favourite}}',
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
        $this->dropTable('{{%favourite}}');

        $this->dropIndex('idx-favourite-user_id', '{{%favourite}}');
        $this->dropForeignKey('fk-favourite-user_id', '{{%favourite}}');
        $this->dropIndex('idx-favourite-product_id', '{{%favourite}}');
        $this->dropForeignKey('fk-favourite-product_id', '{{%favourite}}');

        echo "m191201_135819_favourite cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_135819_favourite cannot be reverted.\n";

        return false;
    }
    */
}
