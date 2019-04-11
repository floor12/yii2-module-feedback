<?php
/* @var $this yii\web\View */
/* @var $model floor12\feedback\models\Feedback */

/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use floor12\feedback\models\FeedbackStatus;

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

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'disabled' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 4, 'disabled' => true]) ?>

        <?= $form->field($model, 'comment')->textarea(['rows' => 4]) ?>

        <?= $form->field($model, 'status')->dropDownList(FeedbackStatus::listData()) ?>
    </div>

    <div class='modal-footer'>
        <?= Html::a('Отмена', '', ['class' => 'btn btn-default modaledit-disable']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>