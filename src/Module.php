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
    public $viewMailUserTemplate = '@vendor/floor12/yii2-module-feedback/src/views/mail/user_thanks.php';
    /**
     * @var string
     */
    public $viewMailAdminTemplate = '@vendor/floor12/yii2-module-feedback/src/views/mail/admin_info.php';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\feedback\controllers';
    /**
     * @var array
     */
    public $attachmentExtensions = ['jpg', 'jpeg', 'png'];
    /**
     * @var bool
     */
    public $attachmentEnable = false;
    /**
     * @var int
     */
    public $attachmentMaxSize = 10000000;
    /**
     * @var array
     */
    public $adminRoles = ['@'];
    /**
     * @var bool
     */
    public $emailRequired = false;
    /**
     * @var bool
     */
    public $phoneRequired = true;

    /**  @var string */
    public $userAgreementUrl = '';

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
