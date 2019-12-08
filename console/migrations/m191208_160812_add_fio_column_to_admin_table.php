<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%admin}}`.
 */
class m191208_160812_add_fio_column_to_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%admin}}', 'fio', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%admin}}', 'fio');
    }
}
