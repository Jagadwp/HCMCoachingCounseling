<?php

use yii\db\Migration;

/**
 * Class m220907_121047_init_rbac
 */
class m220907_121047_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function safeUp()
    // {

    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeDown()
    // {
    //     echo "m220907_121047_init_rbac cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "showCC" permission
        $showCC = $auth->createPermission('showCC');
        $showCC->description = 'Show CC List';
        $auth->add($showCC);

        // add "createCC" permission
        $createCC = $auth->createPermission('createCC');
        $createCC->description = 'Create a CC';
        $auth->add($createCC);

        // add "updateCC" permission
        $updateCC = $auth->createPermission('updateCC');
        $updateCC->description = 'Update CC';
        $auth->add($updateCC);

        // add "deleteCC" permission
        $deleteCC = $auth->createPermission('deleteCC');
        $deleteCC->description = 'Delete CC';
        $auth->add($deleteCC);

        // add "createRequest" permission
        $createRequest = $auth->createPermission('createRequest');
        $createRequest->description = 'Create a Request CC';
        $auth->add($createRequest);

        // add "superior" role and give this role the showCC, createCC, UpdateCC, and DeleteCC permission
        $superior = $auth->createRole('superior');
        $auth->add($superior);
        $auth->addChild($superior, $createCC);
        $auth->addChild($superior, $updateCC);
        $auth->addChild($superior, $deleteCC);
        $auth->addChild($superior, $showCC);

        // add "subordinate" role and give this role the "createRequest" permission
        $subordinate = $auth->createRole('subordinate');
        $auth->add($subordinate);
        $auth->addChild($subordinate, $createRequest);

        // Assign roles to users. number are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($superior, 2);
        $auth->assign($superior, 1);
        $auth->assign($subordinate, 10);
        $auth->assign($subordinate, 9);
        $auth->assign($subordinate, 8);
        $auth->assign($subordinate, 7);
        $auth->assign($subordinate, 6);
        $auth->assign($subordinate, 5);
        $auth->assign($subordinate, 4);
        $auth->assign($subordinate, 3);
    }

    public function down()
    {
        echo "m220907_121047_init_rbac cannot be reverted.\n";

        return false;
        
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
    
}
