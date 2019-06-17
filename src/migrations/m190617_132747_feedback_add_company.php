<?php

use yii\db\Migration;

/**
 * Class m190617_132747_feedback_add_company
 */
class m190617_132747_feedback_add_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%feedback}}', 'company', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%feedback}}', 'company');
    }

}
