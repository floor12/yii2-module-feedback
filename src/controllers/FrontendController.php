<?php

namespace floor12\feedback\controllers;

use floor12\feedback\logic\FeedbackCreate;
use floor12\feedback\models\Feedback;
use floor12\feedback\Module;
use Yii;
use yii\base\ErrorException;
use yii\web\Controller;

class FrontendController extends Controller
{
    /**
     * @var Module
     */
    protected $feedbackModule;

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->feedbackModule = Yii::$app->getModule('feedback');
    }

    /**
     * @param int $id
     * @return string
     * @throws ErrorException
     */
    public function actionForm($id = 0)
    {
        $model = new Feedback();
        $model->type = (int)$id;
        $logic = new FeedbackCreate($model, Yii::$app->request->post());
        if (Yii::$app->request->isPost && $logic->execute())
            return $this->renderAjax($this->feedbackModule->viewSuccessEmbedded);
        return $this->render($this->feedbackModule->viewFormEmbedded, [
            'model' => $model,
            'userAgreementUrl' => $this->module->userAgreementUrl
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws ErrorException
     */
    public function actionFormModal($id = 0)
    {
        $model = new Feedback();
        $model->type = (int)$id;
        $logic = new FeedbackCreate($model, Yii::$app->request->post());
        if (Yii::$app->request->isPost && $logic->execute())
            return $this->renderAjax($this->feedbackModule->viewSuccessModal);
        return $this->renderAjax($this->feedbackModule->viewFormModal, [
            'model' => $model,
            'userAgreementUrl' => $this->module->userAgreementUrl
        ]);
    }

}
