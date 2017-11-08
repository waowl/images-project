<?php

namespace frontend\controllers;

use frontend\models\Feed;
use frontend\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],

        ];
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $limit = Yii::$app->params['feedPostsLimit'];
        $feedItems = $currentUser->getFeed($limit);

        return $this->render('index', [
            'feedItems' => $feedItems,
            'currentUser' => $currentUser,

        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionLanguage()
    {
        $language = Yii::$app->request->post('language');
        Yii::$app->language = $language;

        $langCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30,
        ]);
        Yii::$app->response->cookies->add($langCookie);
        return $this->redirect(Yii::$app->request->referrer);
    }
}



