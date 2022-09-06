<?php

namespace app\controllers;

use app\models\User;
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
}