<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%actions}}`.
 */
class m201012_125353_create_actions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promos}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'image'       => $this->string(),
            'image_hash'  => $this->string(),
            'status'      => $this->integer()->defaultValue(0),
            'is_relevant' => $this->integer()->defaultValue(false),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'meta_t'      => $this->string(),
            'meta_d'      => $this->string(),
            'meta_k'      => $this->string(),
            'h1'          => $this->string(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promos}}');
    }
}
