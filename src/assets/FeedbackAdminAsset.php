<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 19.06.2018
 * Time: 18:07
 */

namespace floor12\feedback\assets;

use yii\web\AssetBundle;

class FeedbackAdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/floor12/yii2-module-feedback/src/assets';

    public $js = [
        'autosubmit.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
