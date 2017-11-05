<?php

use yii\db\Migration;

class m171105_120316_alter_table_post_add_foreign_key extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171105_120316_alter_table_post_add_foreign_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171105_120316_alter_table_post_add_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
