<?php

use yii\db\Migration;

class m171108_100316_alter_table_user_drop_index_unique_on_user extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('username', 'user');
    }

    public function safeDown()
    {
        $this->createIndex('username', 'user', 'username', $unique = true);
    }

}
