<?php

use yii\db\Migration;

class m190410_010101_feedback extends Migration
{


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'phone' => $this->string(14)->null(),
            'email' => $this->string(255)->null(),
            'content' => $this->text()->notNull(),
            'comment' => $this->text()->null(),
        ], $tableOptions);

        $this->createIndex('idx-feedback-status', '{{%feedback}}', 'status');
        $this->createIndex('idx-feedback-type', '{{%feedback}}', 'type');
        $this->createIndex('idx-feedback-email', '{{%feedback}}', 'email');
        $this->createIndex('idx-feedback-phone', '{{%feedback}}', 'phone');
        $this->createIndex('idx-feedback-name', '{{%feedback}}', 'name');
    }

    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }

}
