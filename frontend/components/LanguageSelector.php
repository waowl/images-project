<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.11.2017
 * Time: 17:05
 */

namespace frontend\components;



use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{

    public $supportedLanguages = ['en', 'ru'];
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
            $cookieLanguage = $app->request->cookies['language'];
            if (isset($cookieLanguage) && in_array($cookieLanguage, $this->supportedLanguages)) {
                $app->language = $cookieLanguage;

        }
    }
}