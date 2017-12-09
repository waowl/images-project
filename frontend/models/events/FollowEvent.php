<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.12.2017
 * Time: 18:33
 */

namespace frontend\models\events;


use yii\base\Event;

class FollowEvent extends Event
{
    public $userId;

    public $followedId;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getFollowedId()
    {
        return $this->followedId;
    }



}