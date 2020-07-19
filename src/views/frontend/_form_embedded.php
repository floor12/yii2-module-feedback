<?php
/**
 * @var $this View
 * @var $model Feedback
 */

use floor12\feedback\models\Feedback;
use floor12\feedback\models\FeedbackType;
use floor12\fprotector\Fprotector;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$form = ActiveForm::begin(['id' => 'feedback-form']);

?>

<?= $form->errorSummary($model) ?>

<?= (sizeof(FeedbackType::getList()) > 1) ?
    $form->field($model, 'type')->dropDownList(FeedbackType::getList()) : NULL; ?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'phone')->widget(MaskedInput::class, ['mask' => '+7 (999) 999-99-99']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'email') ?>
    </div>
</div>

<?= $form->field($model, 'content')->textarea(['rows' => 4]) ?>

<?= Fprotector::checkScript('feedbackForm') ?>

<p class="text-right">
    <?= Html::submitButton(Yii::t('app.f12.feedback', 'Send'), ['class' => 'btn btn-primary']) ?>
</p>

<?php if ($userAgreementUrl): ?>
    <p class="f12-feedback-info-block">
        <?= Yii::t('app.f12.feedback', 'By sending a message you agree to our') ?>
        <?= Html::a(Yii::t('app.f12.feedback', 'personal data processing policy'), $userAgreementUrl, [
            'target' => '_blank',
            'data-pjax' => '0'
        ]) ?>.
    </p>
<?php endif; ?>

<?php ActiveForm::end(); ?>
