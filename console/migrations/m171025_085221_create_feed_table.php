<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feed`.
 */
class m171025_085221_create_feed_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feed', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'author_id' => $this->integer(),
            'author_name' => $this->string(),
            'author_nickname' => $this->integer(70),
            'author_picture' => $this->string(),
            'post_id'=> $this->integer(),
            'post_filename' => $this->string()->notNull(),
            'post_description' => $this->text(),
            'post_created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feed');
    }
}
