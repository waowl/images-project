<?php
namespace frontend\components\widgets;
use frontend\models\User;
use Yii;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.12.2017
 * Time: 20:45
 */

class RecommendedWidget extends Widget
{
    public $recommended;

    public function init()
    {
        $currentUser = User::findOne(Yii::$app->user->getId());

        $redis = Yii::$app->redis;
        $key = "user:{$currentUser->getId()}:followers";
        $ids = $redis->smembers($key);

        $users = User::find()->where(['NOT',['id'=> $currentUser->id ]])->all();
        foreach ($users as $user) {
            if((count($user->posts))  && (!in_array($user->id, $ids)) ){
                $this->recommended[] = ['id' => $user->id, 'username' => $user->username, 'nickname' =>$user->nickname, 'picture' => $user->getPicture()] ;
            };
        }

        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        return $this->render('recommended', [
            'recommended' => $this->recommended
        ]);
    }
}