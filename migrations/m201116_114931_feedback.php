<?php

use yii\db\Migration;

/**
 * Class m201116_114931_feedback
 */
class m201116_114931_feedback extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%feedbacks}}', [
            'id'           => $this->primaryKey(),
            'portfolio_id' => $this->integer()->defaultValue(null),
            'portfolio_title' => $this->string()->defaultValue(null),
            'name'         => $this->string()->defaultValue(null),
            'email'        => $this->string()->defaultValue(null),
            'text'         => $this->string()->defaultValue(null),
            'phone'        => $this->string()->defaultValue(null),
            'type'         => $this->string()->notNull(),
            'status'       => $this->integer()->notNull(),
            'created_at'   => $this->integer()->notNull(),
            'updated_at'   => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-feedbacks-portfolio_id',
            'feedbacks',
            'portfolio_id'
        );

        $this->addForeignKey(
            'fk-feedbacks-portfolio_id',
            'feedbacks',
            'portfolio_id',
            'portfolios',
            'id',
            'SET NULL',
            'RESTRICT'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%feedbacks}}');
    }

}
