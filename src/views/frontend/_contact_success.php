<?php
/**
 * @var $this \yii\web\View
 */

use yii\helpers\Html; ?>


<div class="modal-header">
    <h2><span><?= Yii::t('app.f12.feedback', 'Thank you') ?></span></h2>
</div>

<div class="modal-body">
    <p class="modal-info">
        <?= Yii::t('app.f12.feedback', 'Your message has been successfully sent. We will contact you shortly.') ?>
    </p>
</div>

<div class="modal-footer">
    <?= Html::button(Yii::t('app.f12.feedback', 'Close'), ['class' => 'btn btn-default modaledit-disable-silent']) ?>
</div>