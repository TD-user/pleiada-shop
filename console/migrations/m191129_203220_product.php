<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191129_203220_product
 */
class m191129_203220_product extends Migration
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
        $this->createTable('{{%product}}',[
            'id' => Schema::TYPE_PK,
            'category_id' => $this->integer()->notNull(),
            'code_1c' => $this->integer(),
            'parent_code_1c' => $this->integer(),
            'name' => $this->string(400)->notNull(),
            'price' => $this->double()->notNull(),
            'promotionPrice' => $this->double(),
            'currency' => $this->string(),
            'remains' => $this->integer()->notNull(),
            'unit' => $this->string(),
            'article' => $this->string(),
            'manufacturer' => $this->string(),
            'description' => $this->string(),
            'alias'=>$this->string(),
        ],$tableOptions);

        $this->createIndex('idx-product-product_id', '{{%product}}', 'category_id');

        $this->addForeignKey(
            'fk-categories-category_id',
            '{{%product}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');

        $this->dropForeignKey('fk-categories-category_id', 'product');

        echo "m191129_203220_product cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191128_194110_goods cannot be reverted.\n";

        return false;
    }
    */
}
