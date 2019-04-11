<?php


namespace floor12\feedback\models;


use yii2mod\enum\helpers\BaseEnum;

class FeedbackStatus extends BaseEnum
{
    const NEW = 0;
    const REAEDED = 1;

    public static $messageCategory = 'app.f12.feedback';

    public static $list = [
        self::NEW => 'New',
        self::REAEDED => 'Readed'
    ];

}