<?php

namespace app\controllers;

use app\models\Cc;
use app\models\SuperiorWorklist;
use app\models\User;
use PhpParser\Node\Stmt\Foreach_;
use yii\web\Controller;

class SeedController extends Controller
{
    
    public function actionUser()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 10; $i++)
        {
            $values = [
                'superior_id' => ($i <= 2) ?  null : $faker->numberBetween(1, 2),
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'nik' => $faker->nik,
                'password' => \Yii::$app->security->generatePasswordHash('admin'),
                'role' => ($i <= 2) ? 'superior' : 'subordinate',
                'auth_key' => $faker->regexify('[A-Za-z0-9]{20}'),
                'access_token' => $faker->regexify('[A-Za-z0-9]{20}'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),  
            ];
            
            $user = new User();
            $user->attributes = $values;
            $user->insert();
        }

        return $this->render('/site/index');
    }

    public function actionFillcctitle()
    {
        $supWorklist = SuperiorWorklist::find()
                        ->select(['cc_id', 'title'])
                        ->where('cc_id IS NOT NULL')
                        ->asArray()->all();

        
        foreach ($supWorklist as $worklist) {
            $cc = Cc::findOne($worklist['cc_id']);
            $cc->title = $worklist['title'];
            $cc->save();
        }

        // $ccs = Cc::find()->select('id')->where(['title' => ' '])->all();
        // foreach ($ccs as $cc) {
        //     $cc->title = "Coaching & Couseling - {$cc->id}";
        //     $cc->save();
        // }

        return $this->render('/site/index');
    }

    
}