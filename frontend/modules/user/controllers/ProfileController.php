<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.09.2017
 * Time: 16:39
 */

namespace frontend\modules\user\controllers;


use frontend\models\User;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionView($id)
    {
        $user = User::findOne($id);
        return $this->render('view',[
            'user' => $user
        ]);
    }

}