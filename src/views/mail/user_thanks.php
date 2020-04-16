<?php
/**
 * @var $model Feedback
 * @var $this View
 */

use floor12\feedback\models\Feedback;
use yii\web\View;


?>

<p><b><?= Yii::t('app.f12.feedback', 'Thank you') ?>, <?= $model->name ?></b></p>

<p><?= Yii::t('app.f12.feedback', 'Your message has been successfully sent. We will contact you shortly.') ?></p>
