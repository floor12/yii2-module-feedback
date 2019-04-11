<?php


use floor12\Feedback\models\Feedback;
use floor12\editmodal\EditModalHelper;
use floor12\phone\PhoneFormatter;
use kartik\form\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;
use floor12\editmodal\EditModalColumn;
use floor12\feedback\assets\FeedbackAdminAsset;
use floor12\feedback\models\FeedbackType;
use floor12\feedback\models\FeedbackStatus;

FeedbackAdminAsset::register($this);

$this->title = Yii::t('app.f12.feedback', 'Feedback requests');
$this->params['breadcrumbs'][] = $this->title;

?>

    <h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['class' => 'autosubmit', 'data-container' => '#items'],
    'enableClientValidation' => false,
]); ?>

    <div class="filter-block">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'filter')
                    ->label(false)
                    ->textInput([
                        'placeholder' => Yii::t('app.f12.feedback', 'Search'),
                        'autofocus' => true
                    ]);
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'status')
                    ->label(false)
                    ->dropDownList(FeedbackStatus::listData(), ['prompt' => Yii::t('app.f12.feedback', 'all statuses')]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'type')
                    ->label(false)
                    ->dropDownList(FeedbackType::getList(), ['prompt' => Yii::t('app.f12.feedback', 'all types')]) ?>
            </div>
        </div>

    </div>

<?php

ActiveForm::end();

Pjax::begin([
    'id' => 'items',
    'scrollTo' => true,
]);

echo GridView::widget([
    'dataProvider' => $model->dataProvider(),
    'layout' => '{items}{pager}{summary}',
    'tableOptions' => ['class' => 'table table-striped'],
    'columns' => [
        'id',
        'created_at:datetime',
        [
            'header' => Yii::t('app.f12.feedback', 'Name'),
            'attribute' => 'name'
        ],
        [
            'attribute' => 'type',
            'content' => function (Feedback $model) {
                return FeedbackType::getList()[$model->type];
            }
        ],
        [
            'attribute' => 'status',
            'content' => function (Feedback $model) {
                return FeedbackStatus::getLabel($model->status);
            }
        ],
        [
            'header' => Yii::t('app.f12.feedback', 'Contacts'),
            'content' => function (Feedback $model) {
                return PhoneFormatter::run($model->phone);
            }
        ],
        'content',
        [
            'class' => EditModalColumn::class
        ],
    ],
]);

Pjax::end();