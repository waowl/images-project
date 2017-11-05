<?php

use yii\db\Migration;

/**
 * Handles adding description to table `user`.
 */
class m171101_085052_add_description_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'description', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'description');
    }
}
