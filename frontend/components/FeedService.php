<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2017
 * Time: 12:13
 */

namespace frontend\components;


use frontend\models\Feed;
use yii\base\Event;

class FeedService
{
    public function addToFeeds(Event $event)
    {
        $user = $event->getUser();
        $post = $event->getPost();

        $followers = $user->getFollowers();
        foreach ($followers as $follower) {
            $feed = new Feed();
            $feed->user_id = $follower['id'];
            $feed->author_id = $user->id;
            $feed->author_name = $user->username;
            $feed->author_nickname = $user->getNickname();
            $feed->author_picture = $user->getPicture();
            $feed->post_id = $post->id;
            $feed->post_filename = $post->filename;
            $feed->post_description = $post->description;
            $feed->post_created_at = $post->created_at;
            $feed->save();
        }
    }
}