<?php

namespace frontend\tests;

use frontend\tests\fixture\UserFixture;
use Yii;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return ['users' => UserFixture::className()];
    }

    protected function _before()
    {
        Yii::$app->setComponents([
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 1,
            ]
        ]);
    }

    public function testGetNickname()
    {
        $user = $this->tester->grabFixture('users', 'user1');
        expect($user->getNickname())->equals(1);
    }

    public function testFollowUser()
    {
        $user1 = $this->tester->grabFixture('users', 'user1');
        $user2 = $this->tester->grabFixture('users', 'user2');
        $user1->follow($user2);

        $this->tester->sendCommandToRedis('del', 'user:2:followers');
        $this->tester->sendCommandToRedis('del', 'user:1:subscriptions');
    }
}