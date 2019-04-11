<?php

namespace floor12\feedback\controllers;

use floor12\feedback\models\Feedback;
use floor12\feedback\models\FeedbackStatus;
use floor12\feedback\logic\FeedbackCreate;
use Yii;

class FrontendController extends \yii\web\Controller
{
    public function actionForm($id = 0)
    {
        $model = new Feedback();
        $model->type = (int)$id;

        $logic = new FeedbackCreate($model, Yii::$app->request->post());

        if (Yii::$app->request->isPost && $logic->execute())
            return $this->renderAjax('_contact_success');

        return $this->renderAjax('_contact', ['model' => $model]);
    }

}