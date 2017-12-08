<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.12.2017
 * Time: 11:38
 */

namespace frontend\modules\user\controllers;


use frontend\models\User;
use Yii;
use yii\web\Controller;

class SearchController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['*'],
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    public function actionUser()
    {
        $query = Yii::$app->request->post('query');
        $results = User::find()->select('id, username, nickname, picture')->where(['LIKE', 'nickname', $query])->all();

        if ($results) {
            foreach ($results as &$item) {
              $item->picture = $item->getPicture();
            }
            return [
                'success'=> true,
                'results' => $results
            ];
        }
        return [
            'success'=> false,
            'results' => 'empty'
        ];

    }

}