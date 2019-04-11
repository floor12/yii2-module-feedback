<?php

namespace floor12\feedback\logic;

use floor12\feedback\models\FeedbackStatus;
use floor12\feedback\models\Feedback;
use Yii;

class FeedbackCreate
{
    protected $model;
    protected $data = [];

    /**
     * FeedbackCreate constructor.
     * @param Feedback $model
     * @param array $data
     * @throws \yii\base\ErrorException
     */
    public function __construct(Feedback $model, array $data)
    {
        if (!$model->isNewRecord)
            throw new \yii\base\ErrorException('This model already saved.');

        $this->model = $model;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $this->model->status = FeedbackStatus::NEW;
        $this->model->load($this->data);

        $this->model->on(Feedback::EVENT_AFTER_INSERT, function () {
            $this->sendNotificationEmail();
        });

        return $this->model->save();
    }

    /**
     * @return bool
     */
    protected function sendNotificationEmail()
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => "@vendor/floor12/yii2-module-feedback/src/mail/feedback_request.php"],
                ['model' => $this->model]
            )
            ->setFrom([Yii::$app->params['no-replayEmail'] => Yii::$app->params['no-replayName']])
            ->setSubject(Yii::t('app.f12.feedback', 'New feedback form message'))
            ->setTo(Yii::$app->params['contactForm'][$this->model->type]['emails'])
            ->send();
    }

}