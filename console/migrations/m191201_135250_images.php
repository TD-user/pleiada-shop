<?php

use yii\db\Migration;

/**
 * Class m191201_135250_images
 */
class m191201_135250_images extends Migration
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
        $this->createTable('{{%images}}',[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'path' => $this->string(400)->notNull(),
            'title' => $this->string(),
        ],$tableOptions);

        $this->createIndex('idx-images-product_id', '{{%images}}', 'product_id');

        $this->addForeignKey(
            'fk-images-product_id',
            '{{%images}}',
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
        $this->dropTable('{{%images}}');

        $this->dropIndex('idx-images-product_id', '{{%images}}');
        $this->dropForeignKey('fk-images-product_id', '{{%images}}');

        echo "m191201_135250_images cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191201_135250_images cannot be reverted.\n";

        return false;
    }
    */
}
