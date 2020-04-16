<?php

namespace floor12\feedback\controllers;

use floor12\feedback\logic\FeedbackCreate;
use floor12\feedback\models\Feedback;
use Yii;

class FrontendController extends \yii\web\Controller
{
    public $module;

    public function init()
    {
        $this->module = Yii::$app->getModule('feedback');
        parent::init();
    }

    public function actionForm($id = 0)
    {
        $model = new Feedback();
        $model->type = (int)$id;
        $logic = new FeedbackCreate($model, Yii::$app->request->post());
        if (Yii::$app->request->isPost && $logic->execute())
            return $this->renderAjax($this->module->viewSuccess);
        return $this->render($this->module->viewFormEmbeded, ['model' => $model]);
    }

    public function actionFormModal($id = 0)
    {
        $model = new Feedback();
        $model->type = (int)$id;
        $logic = new FeedbackCreate($model, Yii::$app->request->post());
        if (Yii::$app->request->isPost && $logic->execute())
            return $this->renderAjax($this->module->viewSuccessModal);
        return $this->renderAjax($this->module->viewFormModal, ['model' => $model]);
    }

}
