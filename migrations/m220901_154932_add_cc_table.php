<?php

use yii\db\Migration;

/**
 * Class m220901_154932_add_cc_table
 */
class m220901_154932_add_cc_table extends Migration
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
        echo "m220901_154932_add_cc_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('cc', [
            'id' => $this->primaryKey(),
            'superior_id' => $this->integer(),
            'subordinate_id' => $this->integer(),
            'cc_category_id' => $this->integer(),
            'link' => $this->string(),
            'location' => $this->string(),
            'date' => $this->date(),
            'time' => $this->time($precision = 0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `superior_id`
        $this->createIndex(
            'idx-cc-superior_id',
            'cc',
            'superior_id'
        );

        // creates index for column `subordinate_id`
        $this->createIndex(
            'idx-cc-subordinate_id',
            'cc',
            'subordinate_id'
        );

        // add foreign key for table `user(superior)`
        $this->addForeignKey(
            'fk-cc-superior',
            'cc',
            'superior_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        // add foreign key for table `user(subordinate)`
        $this->addForeignKey(
            'fk-cc-subordinate',
            'cc',
            'subordinate_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE',
        );

        // add foreign key for table `cc_category`
        $this->addForeignKey(
            'fk-cc-cc_category',
            'cc',
            'cc_category_id',
            'cc_category',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    public function down()
    {
        echo "m220901_154932_add_cc_table cannot be reverted.\n";

        return false;
    }
}
