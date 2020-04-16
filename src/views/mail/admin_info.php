<?php

use floor12\feedback\models\Feedback;
use floor12\phone\PhoneFormatter;
use yii\web\View;

/**
 * @var $model Feedback
 * @var $this View
 */

?>

<h3>Новое сообщение через форму контактов</h3>

<ul>
    <li>Имя: <?= $model->name ?></li>
    <li>Телефон: <?= PhoneFormatter::run($model->phone) ?></li>
    <li>Почта: <?= Yii::$app->formatter->asEmail($model->email) ?></li>
</ul>

<b>Текст сообщения: </b>
<p><?= nl2br($model->content) ?></p>

<?php if (!empty($model->email)): ?>
    <a href="mailto:<?= $model->email ?>?subject=<?= Yii::t('app.f12.feedback', 'Reply to the feedback form message') ?>&body=жопа">
        Ответить по почте
    </a>
<?php endif; ?>

