<?php

namespace frontend\modules\post\controllers;

use frontend\models\User;
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
        if (Yii::$app->user->isGuest){
            return $this->redirect('/user/default/login');
        }
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
        $comments = Comment::find()->where(['post_id' => $post->id])->with('user')->all();
        return $this->render('view', [
            'post' => $post,
            'currentUser' => $currentUser,
            'commentForm' => $commentForm,
            'comments' => $comments
        ]);
    }

    private function findPost($id)
    {
        if ($post = Post::findOne($id)) {
            return $post;
        }
        throw new NotFoundException();
    }

    /**
     * @return array|string|Response
     */
    public function actionLike()
    {

        $this->enableCsrfValidation = false;

        if(Yii::$app->request->isAjax) {
            return 'ooook';
        }
        if (Yii::$app->user->isGuest){
            return $this->redirect('/user/default/login');
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $post = $this->findPost($id);

        $currentUser = Yii::$app->user->identity;

        $post->like($currentUser);

        return [
            'success' => true,
            'count' => $post->likesCount()
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
            'count' => $post->likesCount()
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

    public function actionComplain()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render(['/user/default/login']);
        }

        Yii::$app->response->format =Response::FORMAT_JSON;

        $id = Yii::$app->request->post('id');

        $currentUser = Yii::$app->user->identity;
        $post = $this->findPost($id);

        if ($post->complain($currentUser)) {
            return [
                'success' => true,
                'text' => 'Post reported'
            ];
        }
        return [
            'success' => false,
            'text' => 'Error'
        ];
    }

}
