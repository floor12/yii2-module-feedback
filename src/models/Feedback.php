<?php


namespace floor12\feedback\models;


use floor12\phone\PhoneValidator;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Feedback
 * @package floor12\feedback\models
 *
 * @property string $name
 * @property string $email
 * @property int $status
 * @property int $type
 * @property string $message
 * @property string $content
 */
class Feedback extends ActiveRecord
{
    const SCENARIO_ADMIN = 'admin';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
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
            [['name'], 'string', 'max' => 255],
            ['name', 'required', 'message' => Yii::t('app.f12.feedback', 'Please, enter your name.')],
            ['content', 'required', 'message' => Yii::t('app.f12.feedback', 'Your message is blank.')],
            [['content'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process', 'on' => self::SCENARIO_ADMIN],
            ['status', 'integer', 'on' => self::SCENARIO_ADMIN]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app.f12.feedback', 'Your name'),
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

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (!$this->phone && !$this->email) {
            $this->addError('phone', Yii::t('app.f12.feedback', 'Enter your phone number or email address.'));
        }

        return parent::beforeValidate();
    }

    /**
     * @return bool
     */
    public function sendMail()
    {
        if (!$this->validate())
            return false;


        Yii::$app
            ->mailer
            ->compose(
                ['html' => "new_contact_message"],
                ['model' => $this]
            )
            ->setFrom([Yii::$app->params['no-replayEmail'] => Yii::$app->params['no-replayName']])
            ->setSubject(Yii::t('app.f12.feedback', 'New message from contact form'))
            ->setTo(Yii::$app->params['contactFormEmails'][$this->type])
            ->send();

        return true;
    }


}