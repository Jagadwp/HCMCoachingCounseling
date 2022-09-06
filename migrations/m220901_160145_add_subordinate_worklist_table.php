<?php

use yii\db\Migration;

/**
 * Class m220901_160145_add_subordinate_worklist_table
 */
class m220901_160145_add_subordinate_worklist_table extends Migration
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
        echo "m220901_160145_add_subordinate_worklist_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('subordinate_worklist', [
            'id' => $this->primaryKey(),
            'subordinate_id' => $this->integer(),
            'superior_id' => $this->integer(),
            'title' => $this->string(),
            'cc_category_id' => $this->integer(),
            'cc_id' => $this->integer(),
            'isValid' => $this->boolean(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            
            
        ]);

        // creates index for column `subordinate_id`
        $this->createIndex(
            'idx-subordinate_worklist-subordinate_id',
            'subordinate_worklist',
            'subordinate_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-subordinate_worklist-user',
            'subordinate_worklist',
            'subordinate_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        // add foreign key for table `cc_category`
        $this->addForeignKey(
            'fk-subordinate_worklist-cc_category',
            'subordinate_worklist',
            'cc_category_id',
            'cc_category',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    public function down()
    {
        echo "m220901_160145_add_subordinate_worklist_table cannot be reverted.\n";

        return false;
    }
}
