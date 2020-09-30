<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faq_question}}`.
 */
class m200929_080529_create_faq_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%faq_question}}', [
            'id'       => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer'   => $this->text(),
            'position' => $this->integer()->notNull(),
            'status'   => $this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faq_question}}');
    }
}
