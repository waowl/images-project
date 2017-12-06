<?php

use yii\db\Migration;

class m171206_124347_alter_table_user_drop_description extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user', 'description');

    }

    public function safeDown()
    {
        echo "m171206_124347_alter_table_user_drop_description cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_124347_alter_table_user_drop_description cannot be reverted.\n";

        return false;
    }
    */
}
