<?php

namespace floor12\feedback\logic;

use floor12\feedback\models\Feedback;
use floor12\feedback\models\FeedbackStatus;
use floor12\feedback\Module;
use Yii;
use yii\base\ErrorException;

class FeedbackCreate
{
    /**
     * @var Feedback
     */
    protected $model;
    /**
     * @var Module
     */
    protected $module;
    /**
     * @var array
     */
    protected $data = [];

    /**
     * FeedbackCreate constructor.
     * @param Feedback $model
     * @param array $data
     * @throws ErrorException
     */
    public function __construct(Feedback $model, array $data)
    {
        if (!$model->isNewRecord)
            throw new ErrorException('This feedback already saved.');

        $this->model = $model;
        $this->data = $data;
        $this->module = Yii::$app->getModule('feedback');
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $this->model->status = FeedbackStatus::NEW;
        $this->model->load($this->data);

        if (!$this->model->type)
            $this->model->type = 0;

        $this->model->on(Feedback::EVENT_AFTER_INSERT, function () {
            $this->validateParams();
            if ($this->model->email)
                $this->sendThankEmail();
            $this->sendNotificationEmail();
        });

        return $this->model->save();
    }

    /**
     * @return bool
     */
    protected function sendThankEmail()
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => $this->module->viewMailUserTemplate],
                ['model' => $this->model]
            )
            ->setFrom([Yii::$app->params['no-replyEmail'] => Yii::$app->params['no-replyName']])
            ->setTo($this->model->email)
            ->setSubject(Yii::t('app.f12.feedback', 'Thank you for contact us'))
            ->send();
    }

    /**
     * @return bool
     */
    protected function sendNotificationEmail()
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => $this->module->viewMailAdminTemplate],
                ['model' => $this->model]
            )
            ->setFrom([Yii::$app->params['no-replyEmail'] => Yii::$app->params['no-replyName']])
            ->setSubject(Yii::t('app.f12.feedback', 'New feedback form message'))
            ->setTo(Yii::$app->params['contactForm'][$this->model->type]['emails'])
            ->send();
    }

    /**
     * @throws ErrorException
     */
    protected function validateParams()
    {
        if (empty(Yii::$app->params['no-replyEmail']))
            throw new ErrorException('Parameter `no-replyEmail` not found in app params.');

        if (empty(Yii::$app->params['no-replyName']))
            throw new ErrorException('Parameter `no-replyName` not found in app params.');
    }
}
