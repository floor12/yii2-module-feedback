<?php


namespace floor12\feedback\models;

use Yii;

/**
 * Class FeedbackType
 * @package floor12\feedback\models
 */
class FeedbackType
{
    /**
     * @return array
     */
    public static function getList()
    {
        $list = [];
        if (!Yii::$app->params['contactForm'])
            return $list;

        foreach (Yii::$app->params['contactForm'] as $formOption) {
            $list[] = $formOption['title'];
        }
        return $list;
    }
}