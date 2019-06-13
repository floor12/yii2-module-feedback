<?php

namespace floor12\feedback\components;

use floor12\editmodal\EditModalAsset;
use floor12\editmodal\EditModalHelper;
use yii\base\Widget;
use yii\helpers\Html;

class OpenContactModalButtonWidget extends Widget
{
    /** @var string */
    public $content;
    public $url;
    public $class = 'btn btn-default';

    public function run()
    {
        EditModalAsset::register($this->getView());
        return Html::button($this->content, ['onclick' => EditModalHelper::showForm([$this->url]), 'class' => $this->class]);
    }

}