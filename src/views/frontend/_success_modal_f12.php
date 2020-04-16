<?php
/**
 * @var $this View
 */

use yii\helpers\Html;
use yii\web\View;

?>


<div class="modal-header">
    <h2><?= Yii::t('app.f12.feedback', 'Thank you') ?></h2>
</div>

<div class="modal-body">
    <p class="modal-info">
        <?= Yii::t('app.f12.feedback', 'Your message has been successfully sent. We will contact you shortly.') ?>
    </p>
</div>

<div class="modal-footer">
    <?= Html::button(Yii::t('app.f12.feedback', 'Close'), [
        'class' => 'btn btn-default',
        'onclick' => 'return f12editmodal.close();'
    ]) ?>
</div>
