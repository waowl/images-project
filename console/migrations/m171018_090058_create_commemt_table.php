<?php

use yii\db\Migration;

/**
 * Handles the creation of table `commemt`.
 */
class m171018_090058_create_commemt_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('commemt', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('commemt');
    }
}
