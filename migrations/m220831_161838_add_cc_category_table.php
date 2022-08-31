<?php

use yii\db\Migration;

/**
 * Class m220831_161838_add_cc_category_table
 */
class m220831_161838_add_cc_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220831_161838_add_cc_category_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('cc_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(55)->notNull(),
            'description' => $this->text(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $descIrregular = 'System will launch apps surrounding';
        $descRegular = 'Regular type, superior must input result of CC into system';
        $ts = date("Y-m-d H:i:s");

        $this->batchInsert('cc_category', ['name', 'description', 'created_at'], [
            ['Learning Plan', $descIrregular, $ts],
            ['Career Plan', $descIrregular, $ts],
            ['Goal Setting', $descIrregular, $ts],
            ['Target Monitoring', $descIrregular, $ts],
            ['Achievement', $descIrregular, $ts],
            ['Regular', $descRegular, $ts],
        ]);

    }

    public function down()
    {
        echo "m220831_161838_add_cc_category_table cannot be reverted.\n";

        return false;
    }
}
