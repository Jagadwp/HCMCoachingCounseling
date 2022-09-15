<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cc_result}}`.
 */
class m220913_161003_add_status_column_to_cc_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cc_result}}', 'status', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cc_result}}', 'status');
    }
}
