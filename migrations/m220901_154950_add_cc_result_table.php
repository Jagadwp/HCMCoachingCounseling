<?php

use yii\db\Migration;

/**
 * Class m220901_154950_add_cc_result_table
 */
class m220901_154950_add_cc_result_table extends Migration
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
        echo "m220901_154950_add_cc_result_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('cc_result', [
            'id' => $this->primaryKey(),
            'cc_id' => $this->integer(),
            'condition' => $this->text(),
            'problem' => $this->text(),
            'note' => $this->text(),
            'result' => $this->text()->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `cc_id`
        $this->createIndex(
            'idx-cc_result-cc_id',
            'cc_result',
            'cc_id'
        );

        // add foreign key for table `cc`
        $this->addForeignKey(
            'fk-cc_result-cc',
            'cc_result',
            'cc_id',
            'cc',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    public function down()
    {
        echo "m220901_154950_add_cc_result_table cannot be reverted.\n";

        return false;
    }
}
