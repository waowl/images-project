<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2017
 * Time: 12:36
 */
namespace frontend\models\events;

use yii\base\Event;

class PostCreatedEvent extends Event
{
    public $user;

    public $post;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }



}