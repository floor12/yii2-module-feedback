<?php
/* @var $this yii\web\View */
/* @var $model floor12\feedback\models\Feedback */

/* @var $form yii\widgets\ActiveForm */

use floor12\feedback\models\FeedbackStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'modal-form',
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]);
?>

    <div class='modal-header'>
        <h2><?= $model->isNewRecord ? 'Создание' : 'Редактирование' ?> объекта</h2>
    </div>

    <div class='modal-body'>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
        </div>

        <?= $form->field($model, 'content')->textarea(['rows' => 4, 'disabled' => true]) ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 4]) ?>

        <?= $form->field($model, 'status')->dropDownList(FeedbackStatus::listData()) ?>

        <?= $form->field($model, 'files')->widget(\floor12\files\components\FileInputWidget::class) ?>
    </div>

    <div class='modal-footer'>
        <?= Html::a('Отмена', '', ['class' => 'btn btn-default modaledit-disable']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>