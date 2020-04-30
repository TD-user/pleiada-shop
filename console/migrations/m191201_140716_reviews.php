<?php

use yii\db\Migration;

/**
 * Class m191201_140716_reviews
 */
class m191201_140716_reviews extends Migration
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

        $this->createTable('{{%reviews}}',[
            'id'=>$this->primaryKey(),
            'product_id'=>$this->integer(11),
            'user_id'=>$this->integer(11),
            'name'=>$this->string(),
            'text'=>$this->string(5000),
            'created_at' => $this->integer(),
            'is_moderated'=>$this->integer(),
            'moderator_id'=>$this->integer(11),
            'moderated_at' => $this->integer(),
        ],$tableOptions);

        $this->createIndex('idx-reviews-product_id', '{{%reviews}}', 'product_id');

        $this->addForeignKey('fk-reviews-product_id',
            '{{%reviews}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        $this->createIndex('idx-reviews-user_id', '{{%reviews}}', 'user_id');

        $this->addForeignKey('fk-reviews-user_id',
            '{{%reviews}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');

        $this->dropIndex('idx-reviews-product_id', '{{%reviews}}');
        $this->dropForeignKey('fk-reviews-product_id', '{{%reviews}}');
        $this->dropIndex('idx-reviews-user_id', '{{%reviews}}');
        $this->dropForeignKey('fk-reviews-user_id', '{{%reviews}}');

        echo "m191201_140716_reviews cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_140716_reviews cannot be reverted.\n";

        return false;
    }
    */
}
