<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.09.2017
 * Time: 16:39
 */

namespace frontend\modules\user\controllers;


use frontend\models\Post;
use frontend\models\User;
use frontend\modules\user\models\EditForm;
use frontend\modules\user\models\form\PictureForm;
use PHPUnit\Runner\Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    // TODO: check will be uploading work?
   /* public function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "upload-picture");
        return parent::beforeAction($action);
    }*/

    public function actionView($nickname)
    {

        $currentUser = Yii::$app->user->identity;
        if ($currentUser) {
            $picture = new PictureForm();
            return $this->render('view', [
                'user' => $this->findUser($nickname),
                'currentUser' => $currentUser,
                'modelPicture' => $picture
            ]);
        }
        return $this->redirect('/user/default/login');
    }

    public function actionSubscribe($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        /** @var  $currentUser  User */
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);

        try {
            $currentUser->follow($user);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->redirect(['/user/profile/view/', 'nickname' => $currentUser->getNickname()]);
    }

    public function actionUnsubscribe($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }
        /** @var  $currentUser  User */
        $currentUser = Yii::$app->user->identity;
        $user = $this->findUserById($id);
        $currentUser->unFollow($user);

        return $this->redirect(['/user/profile/view/', 'nickname' => $currentUser->getNickname()]);
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

    public function actionUploadPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model, 'picture');

        if ($model->validate()) {
            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);
            if ($user->save(false, ['picture'])) {
                return [
                    'success' => true,
                    'pictureUrl' => Yii::$app->storage->getFile($user->picture)
                ];
            }
        }
        return [
            'success' => false,
            'errors' => $model->getErrors()
        ];
    }

    public function actionDeletePicture()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/user/default/login');
        }

        $currentUser = Yii::$app->user->identity;

        if ($currentUser->deletePicture()) {
            Yii::$app->session->setFlash('success', 'Picture deleted');
        } else {
            Yii::$app->session->setFlash('danger', 'Error occured');
        }
        return $this->redirect(['/user/profile/view', 'nickname' => $currentUser->getNickname()]);
    }

    /**
     * @param mixed $nickname
     * @return string|Response
     */
    public function actionEdit($nickname)
    {
        $currentUser = Yii::$app->user->identity;
        if ($currentUser) {
            $modelPicture = new PictureForm();

            $user = $this->findUser($nickname);
            $user->scenario = User::SCENARIO_EDIT;

            if ($user->load(Yii::$app->request->post()) && $user->save()) {
                return $this->redirect(['/user/profile/view', 'nickname' => $user->getNickname()]);
            } else {
                return $this->render('edit', [
                    'currentUser' => $currentUser,
                    'user' => $user,
                    'modelPicture' => $modelPicture,
                ]);
            }
        }
    }
}