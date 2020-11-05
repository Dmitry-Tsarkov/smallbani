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
            'image_hash' => $this->string()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'meta_t'     => $this->string()->defaultValue(null),
            'meta_d'     => $this->string()->defaultValue(null),
            'meta_k'     => $this->string()->defaultValue(null),
            'h1'         => $this->string()->defaultValue(null),
            'lft'        => $this->integer()->notNull(),
            'rgt'        => $this->integer()->notNull(),
            'depth'      => $this->integer()->notNull(),
            'parent_id'  => $this->integer()->defaultValue(null)
        ]);

        $this->insert('catalog_categories', [
            'title' => '',
            'alias' => '',
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
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
