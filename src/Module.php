<?php

namespace floor12\feedback;

use Yii;

/**
 * feedback module definition class
 * @property  string $editRole
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $adminLayout = '@app/views/layouts/main';
    /**
     * @var string
     */
    public $frontendLayout = '@app/views/layouts/main';
    /**
     * @var string
     */
    public $viewFormModal = '@vendor/floor12/yii2-module-feedback/src/views/frontend/_form_modal_bs';
    /**
     * @var string
     */
    public $viewFormEmbedded = '@vendor/floor12/yii2-module-feedback/src/views/frontend/_form_embedded';
    /**
     * @var string
     */
    public $viewSuccessModal = '@vendor/floor12/yii2-module-feedback/src/views/frontend/_success_modal_bs';
    /**
     * @var string
     */
    public $viewSuccessEmbedded = '@vendor/floor12/yii2-module-feedback/src/views/frontend/_success_embedded';
    /**
     * @var string
     */
    public $userModel = 'app\models\User';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\feedback\controllers';
    /**
     * @var string
     */
    public $adminRoles = ['@'];
    /**
     * @var bool
     */
    public $emailRequired = false;
    /**
     * @var bool
     */
    public $phoneRequired = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->registerTranslations();
    }
    /**
     *
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['app.f12.feedback'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@vendor/floor12/yii2-module-feedback/src/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'app.f12.feedback' => 'feedback.php',
            ],
        ];
    }

}
