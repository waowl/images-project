<?php

namespace frontend\modules\post\controllers;

use common\models\User;
use frontend\models\Comment;
use frontend\models\Post;
use frontend\modules\post\models\forms\CommentForm;
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
        $commentForm = new CommentForm($currentUser);
        $post = $this->findPost($id);
        $comments = $this->getComments($post);
        return $this->render('view', [
            'post' => $post,
            'currentUser' => $currentUser,
            'commentForm' => $commentForm,
            'comments' => $comments
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

    public function actionComment($id)
    {
        $model = new CommentForm(Yii::$app->user->identity);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save($id)) {
                    Yii::$app->session->setFlash('success', 'Комментарий добавлен');
                    return $this->redirect(['/post/' . $id]);
                }
            }
        }
    }

    public function actionCommentDelete($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->delete()) {
            Yii::$app->session->setFlash('success', 'Ваш комментарий  удалён');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCommentEdit($id)
    {
        $currentUser = Yii::$app->user->identity;
        $commentForm = new CommentForm($currentUser);
        $commentForm->attributes = Yii::$app->request->post();
        if ($commentForm->update($id)) {
            Yii::$app->session->setFlash('success', 'Ваш комментарий  обновлён');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }


    private function getComments($post)
    {
        return $post->comments;
    }

}
