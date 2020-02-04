<?php

use yii\db\Migration;

/**
 * Class m200204_132101_add_code_1c_to_categories
 */
class m200204_132101_add_code_1c_to_categories extends Migration
{
    public function up()
    {
        $this->addColumn('{{%categories}}', 'code_1c', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%categories}}', 'code_1c');
    }
}
