<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.09.2017
 * Time: 16:39
 */

namespace frontend\modules\user\controllers;


use frontend\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {
        //TODO:доделать отображнение
        $currentUser = Yii::$app->user->identity;
        return $this->render('view', [
            'user' => $this->findUser($nickname),
            'currentUser' => $currentUser
        ]);
    }

    public function actionSubscribe($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        /** @var  $currentUser  User*/
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);


        $currentUser->follow($user);

        return $this->redirect(['/user/profile/view/', 'nickname'=> $user->getNickname()]);
    }

    public function actionUnsubscribe($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        /** @var  $currentUser  User*/
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);


        $currentUser->unFollow($user);

        return $this->redirect(['/user/profile/view/', 'nickname'=> $user->getNickname()]);
    }

    /**
     * @param string $id
     * @return User
     * @throws NotFoundHttpException
     */

    private function findUserById($id)
    {
        if ($user = User::findOne($id)) {
            return $user;
        }
        throw new NotFoundHttpException();
    }

    /**
     * @param string $nickname
     * @return User
     * @throws NotFoundHttpException
     */

    private function findUser($nickname)
    {
        if ($user = User::find()->where(['nickname' => $nickname])->orWhere(['id' => $nickname])->one()) {
            return $user;
        }
        throw new NotFoundHttpException();
    }


}