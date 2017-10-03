<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.10.2017
 * Time: 10:00
 */

namespace frontend\controllers;


use Faker\Factory;
use frontend\models\User;
use Yii;
use yii\web\Controller;

class FakerController extends Controller
{
    public function actionGenerateUsers()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            $user = new User([
                'username' => $faker->name,
                'email' => $faker->email,
                'about' => $faker->text(200),
                'nickname' => $faker->regexify('[A-Za-z0-9_]{5,15}'),
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generateRandomString(),
                'created_at' => $time = time(),
                'updated_at' => $time

            ]);
            $user->save(false);
        }
    }
}