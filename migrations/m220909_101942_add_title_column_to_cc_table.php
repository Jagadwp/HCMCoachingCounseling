<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{cc`.
 */
class m220909_101942_add_title_column_to_cc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cc', 'title', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cc', 'title');
    }
}
