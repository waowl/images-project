<?php
namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2017
 * Time: 12:35
 */

class Storage extends Component implements StorageInterface
{
    private $fileName;

    /**
     * @param \yii\web\UploadedFile $file
     */
    public function saveUploadedFile(UploadedFile $file)
    {
       $path = $this->preparePath($file);

       if ($path && $file->saveAs($path)) {
           return $this->fileName;
       }
    }

    /**
     * @param string $filename
     */
    public function getFile(string $filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }

    /**
     * Prepare path to save uploaded file
     * @param UploadedFile $file
     * @return string | null
     */
    private function preparePath($file)
    {
        $this->fileName = $this->getFileName($file);

        $path = $this->getStoragePath() . $this->fileName;

        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
    */
    private function getFileName($file)
    {
        $hash = sha1_file($file->tempName);
        $name = substr_replace($hash, '/',2 , 0);
        $name = substr_replace($name, '/',5 , 0);

        return $name . '.' . $file->extension;
    }

    private function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    public function deletePicture(string $filename)
    {
        $file = $this->getStoragePath().$filename;

        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }
}