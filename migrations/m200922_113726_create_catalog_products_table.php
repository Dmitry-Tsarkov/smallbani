<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_products}}`.
 */
class m200922_113726_create_catalog_products_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%catalog_products}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'status'      => $this->integer()->notNull(),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'category_id' => $this->integer()->defaultValue(null),
            'image_id'    => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex('idx-catalog_products-category_id', 'catalog_products', 'category_id');
        $this->addForeignKey('fk-catalog_products-category_id', 'catalog_products', 'category_id', 'catalog_categories', 'id', 'SET NULL', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-catalog_products-category_id', 'catalog_products');
        $this->dropIndex('idx-catalog_products-category_id', 'catalog_products');
        $this->dropTable('{{%catalog_products}}');
    }
}
