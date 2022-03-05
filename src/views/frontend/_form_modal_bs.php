<?php
/**
 * @var $this View
 * @var $model Feedback
 * @var $userAgreementUrl string
 */

use floor12\editmodal\EditModalHelper;
use floor12\feedback\models\Feedback;
use floor12\feedback\models\FeedbackType;
use floor12\fprotector\Fprotector;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]); ?>

<div class="modal-header">
    <div class="pull-right">
        <?= EditModalHelper::btnFullscreen(['class' => 'btn btn-default']) ?>
        <?= EditModalHelper::btnClose(['class' => 'btn btn-default']) ?>
    </div>
    <h2><span><?= Yii::t('app.f12.feedback', 'Send us a message') ?></span></h2>
</div>

<div class="modal-body">

    <p>
        <?= Yii::t('app.f12.feedback', 'If you have any questions or suggestions, you can contact us using this form.') ?>
    </p>

    <br>

    <?= $form->errorSummary($model) ?>

    <?= (sizeof(FeedbackType::getList()) > 1) ?
        $form->field($model, 'type')->dropDownList(FeedbackType::getList()) : NULL; ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => 4]) ?>

    <?php if ($userAgreementUrl): ?>
        <p class="f12-feedback-info-block">
            <?= Yii::t('app.f12.feedback', 'By sending a message you agree to our') ?>
            <?= Html::a(Yii::t('app.f12.feedback', 'personal data processing policy'), $userAgreementUrl, [
                'target' => '_blank',
            ]) ?>.
        </p>
    <?php endif; ?>

</div>

<div class="modal-footer">
    <?= Fprotector::checkScript('feedbackForm') ?>
    <?= Html::button(Yii::t('app.f12.feedback', 'Close'), ['class' => 'btn btn-default modaledit-disable-silent']) ?>
    <?= Html::submitButton(Yii::t('app.f12.feedback', 'Send'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
