<?php

use yii\db\Migration;

class m171105_120316_table_feed_add_foreign_key extends Migration
{


    public function up()
    {

        $this->addForeignKey('fk_feed', 'feed', 'post_id', 'post', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_feed', 'feed');
    }
}
