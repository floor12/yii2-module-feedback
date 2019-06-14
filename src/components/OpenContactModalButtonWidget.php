<?php

namespace floor12\feedback\components;

use floor12\editmodal\EditModalAsset;
use floor12\editmodal\EditModalHelper;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class OpenContactModalButtonWidget extends Widget
{
    /** @var string */
    public $content;
    public $url;
    public $ariaLabel;
    public $cssClass = 'btn btn-default';

    public function run()
    {
        EditModalAsset::register($this->getView());

        Yii::$app->getModule('feedback');

        return Html::button($this->content, [
            'aria-label' => $this->ariaLabel ?: Yii::t('app.f12.feedback', 'Open feedback form'),
            'onclick' => EditModalHelper::showForm([$this->url]),
            'class' => $this->cssClass
        ]);
    }

}