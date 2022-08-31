<?php

use yii\db\Migration;

/**
 * Class m220831_141716_add_user_table
 */
class m220831_141716_add_user_table extends Migration
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
        echo "m220831_141716_add_user_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'superior_id' => $this->integer(),
            'name' => $this->string(55)->notNull(),
            'email' => $this->string(55)->unique()->notNull(),
            'nik' => $this->char(16)->notNull(),
            'password' => $this->string()->notNull(),
            'role' => $this->string(),
            'auth_key' => $this->string(),
            'access_token' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

    }

    public function down()
    {
        echo "m220831_141716_add_user_table cannot be reverted.\n";

        return false;
    }
}
