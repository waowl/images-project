<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $filename
 * @property string $description
 * @property integer $created_at
 * @property integer $complaints
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * find post's complaints
     * @return $this
     */
    public static function findComplaints() {
        return self::find()->where('complaints > 0')->orderBy('complaints DESC');
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
            'complaints' => 'Complaints',
        ];
    }

    /**
     *  get post's picture
     * @return string
     */
    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }


    /**
     * approve a post
     * @return bool
     */
    public function  approve() {
        $redis = Yii::$app->redis;
        $key = "post:$this->id:complaints";

        $redis->del($key);

        $this->complaints = 0;
        return $this->save(false, ['complaints']);
    }
}
