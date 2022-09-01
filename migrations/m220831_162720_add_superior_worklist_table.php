<?php

use yii\db\Migration;

/**
 * Class m220831_162720_add_superior_worklist_table
 */
class m220831_162720_add_superior_worklist_table extends Migration
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
        echo "m220831_162720_add_superior_worklist_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('superior_worklist', [
            'id' => $this->primaryKey(),
            'superior_id' => $this->integer(),
            'subordinate_id' => $this->integer(),
            'title' => $this->string(),
            'cc_category_id' => $this->integer(),
            'cc_id' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            
            
        ]);

        // creates index for column `superior_id`
        $this->createIndex(
            'idx-superior_worklist-superior_id',
            'superior_worklist',
            'superior_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-superior_worklist-user',
            'superior_worklist',
            'superior_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        // add foreign key for table `cc_category`
        $this->addForeignKey(
            'fk-superior_worklist-cc_category',
            'superior_worklist',
            'cc_category_id',
            'cc_category',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    public function down()
    {
        echo "m220831_162720_add_superior_worklist_table cannot be reverted.\n";

        return false;
    }

}
