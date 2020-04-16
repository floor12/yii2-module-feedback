<?php


namespace floor12\feedback\models;


use floor12\feedback\Module;
use floor12\phone\PhoneValidator;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Feedback
 * @package floor12\feedback\models
 *
 * @property string $name
 * @property string $company
 * @property string $email
 * @property string $phone
 * @property int $status
 * @property int $type
 * @property string $message
 * @property string $content
 */
class Feedback extends ActiveRecord
{
    const SCENARIO_ADMIN = 'admin';
    /**
     * @var Module
     */
    protected $feedbackModule;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->feedbackModule = Yii::$app->getModule('feedback');
        parent::init();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['type', 'integer'],
            ['phone', PhoneValidator::class],
            ['email', 'email'],
            [['name', 'company'], 'string', 'max' => 255],
            ['name', 'required', 'message' => Yii::t('app.f12.feedback', 'Please, enter your name.')],
            ['content', 'required', 'message' => Yii::t('app.f12.feedback', 'Your message is blank.')],
            [['content'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
            ['status', 'integer', 'on' => self::SCENARIO_ADMIN],
            ['email', 'required', 'when' => function () {
                return $this->feedbackModule->emailRequired;
            }],
            ['phone', 'required', 'when' => function () {
                return $this->feedbackModule->phoneRequired;
            }],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app.f12.feedback', 'Your name'),
            'company' => Yii::t('app.f12.feedback', 'Company name'),
            'phone' => Yii::t('app.f12.feedback', 'Phone number'),
            'email' => Yii::t('app.f12.feedback', 'Email'),
            'content' => Yii::t('app.f12.feedback', 'Your message'),
            'type' => Yii::t('app.f12.feedback', 'Question type'),
            'created_at' => Yii::t('app.f12.feedback', 'Created at'),
            'status' => Yii::t('app.f12.feedback', 'Status'),
            'comment' => Yii::t('app.f12.feedback', 'Comment'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'Timestamp' => [
                'class' => TimestampBehavior::class,
            ]
        ];
    }

}
