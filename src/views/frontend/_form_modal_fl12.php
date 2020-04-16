<?php
/**
 * @var $this View
 * @var $model ContactForm
 */

use common\src\form\ContactForm;
use common\src\form\ContactType;
use floor12\editmodal\EditModalHelper2;
use floor12\feedback\models\FeedbackType;
use floor12\fprotector\Fprotector;
use frontend\components\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]); ?>

<div class="modal-header">
    <div class="pull-right">
        <?= EditModalHelper2::btnFullscreen(['class' => 'btn btn-default']) ?>
        <?= EditModalHelper2::btnClose(['class' => 'btn btn-default']) ?>
    </div>
    <h2><span><?= Yii::t('app.f12.feedback', 'Send us a message') ?></span></h2>
</div>

<div class="modal-body">

    <p class="modal-info">
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
            <?= $form->field($model, 'phone')->widget(MaskedInput::class, ['mask' => '+7 (999) 999-99-99']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => 4]) ?>

</div>

<div class="modal-footer">
    <?= Fprotector::checkScript('feedbackForm') ?>
    <?= Html::button(Yii::t('app.f12.feedback', 'Close'), ['class' => 'btn btn-default', 'onclick' => 'return f12editmodal.close()']) ?>
    <?= Html::submitButton(Yii::t('app.f12.feedback', 'Send'), ['class' => 'btn btn-primary', 'onclick' => 'return f12editmodal.submit();']) ?>
</div>

<?php ActiveForm::end(); ?>
