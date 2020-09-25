<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catalog_product_images}}`.
 */
class m200922_113755_create_catalog_product_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catalog_product_images}}', [
            'id'          => $this->primaryKey(),
            'product_id'  => $this->integer(),
            'image'       => $this->string(),
            'image_hash'  => $this->string(),
            'position'    => $this->integer()
        ]);

        $this->createIndex('idx-catalog_product_images-product_id', 'catalog_product_images', 'product_id');
        $this->addForeignKey('fk-catalog_product_images-product_id', 'catalog_product_images', 'product_id', 'catalog_products', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-catalog_product_images-product_id', 'catalog_product_images');
        $this->dropIndex('idx-catalog_product_images-product_id', 'catalog_product_images');
        $this->dropTable('{{%catalog_product_images}}');
    }
}
