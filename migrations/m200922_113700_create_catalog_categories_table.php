<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_categories}}`.
 */
class m200922_113700_create_catalog_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_categories}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string()->notNull(),
            'alias'      => $this->string()->notNull(),
            'status'     => $this->integer()->notNull(),
            'image'      => $this->string(500),
            'image_hash' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position'   => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catalog_categories}}');
    }
}
