<?php
/**
 * @var $this View
 * @var $model ContactForm
 */

use common\src\form\ContactForm;
use common\src\form\ContactType;
use frontend\components\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \floor12\feedback\models\FeedbackType;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;

?>
<?php $form = ActiveForm::begin([
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => false
]); ?>

<div class="modal-header">
    <h2><span><?= Yii::t('app.f12.feedback', 'Send us a message') ?></span></h2>
</div>

<div class="modal-body">

    <p class="modal-info">
        <?= Yii::t('app.f12.feedback', 'If you have any questions or suggestions, you can contact us using this form.') ?>
    </p>

    <?= $form->field($model, 'type')->widget(Select2::class, ['data' => FeedbackType::getList()]) ?>

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
    <?= Html::button(Yii::t('app.f12.feedback', 'Close'), ['class' => 'btn btn-default modaledit-disable-silent']) ?>
    <?= Html::submitButton(Yii::t('app.f12.feedback', 'Send'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
