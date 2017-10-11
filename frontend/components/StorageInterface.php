<?php

namespace frontend\components;
use yii\web\UploadedFile;

interface StorageInterface
{
    /**
     * @param UploadedFile $file
     */
    public function saveUploadedFile(UploadedFile $file);

    /**
     * @param string $file
     */
    public function getFile(string $file);
}