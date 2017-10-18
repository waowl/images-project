<?php

namespace frontend\modules\post\controllers;

use frontend\models\Post;
use frontend\modules\post\models\forms\PostForm;
use Intervention\Image\Exception\NotFoundException;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class DefaultController extends Controller
{
    public function actionCreate()
    {
        $model = new PostForm(Yii::$app->user->identity);
        if ($model->load(Yii::$app->request->post())) {
            $model->filename = UploadedFile::getInstance($model, 'filename');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пост Создан');
                return $this->goHome();
            }
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $currentUser = Yii::$app->user->identity;
        return $this->render('view', [
           'post' =>  $this->findPost($id),
            'currentUser' => $currentUser
        ]);
    }

    private function findPost($id)
    {
        if ($user = Post::findOne($id)) {
            return $user;
        }
        throw new NotFoundException();
    }

    public function actionLike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render(['/user/default/login']);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $post = $this->findPost($id);

        $currentUser = Yii::$app->user->identity;

        $post->like($currentUser);

        return [
            'success' => true,
            'count' => $post->countLikes()
        ];
    }

    public function actionUnlike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render(['/user/default/login']);
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $post = $this->findPost($id);

        $currentUser = Yii::$app->user->identity;

        $post->unLike($currentUser);

        return [
            'success' => true,
            'count' => $post->countLikes()
        ];
    }

}
