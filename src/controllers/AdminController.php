<?php

namespace floor12\feedback\controllers;


use floor12\feedback\models\Feedback;
use floor12\feedback\models\FeedbackFilter;
use floor12\editmodal\DeleteAction;
use floor12\editmodal\IndexAction;
use floor12\editmodal\EditModalAction;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * AdminController implements the CRUD actions for Feedback model.
 */
class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => Yii::$app->getModule('feedback')->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'form' => ['GET', 'POST'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout = Yii::$app->getModule('feedback')->adminLayout;
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'model' => FeedbackFilter::class,
            ],
            'form' => [
                'class' => EditModalAction::class,
                'model' => Feedback::class,
                'scenario' => Feedback::SCENARIO_ADMIN,
                'message' => Yii::t('app.f12.feedback', 'Feedback item updated')
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'model' => Feedback::class,
                'message' => Yii::t('app.f12.feedback', 'Feedback item deleted')
            ],
        ];
    }


}
