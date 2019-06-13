<?php

use floor12\feedback\models\Feedback;
use yii\web\View;

/**
 * @var $model Feedback
 * @var $this View
 */

?>


<p><b><?= Yii::t('app.f12.feedback', 'Thank you') ?>, <?= $model->name ?></b></p></b>

<p><?= Yii::t('app.f12.feedback', 'Your message has been successfully sent. We will contact you shortly.') ?></p>
