<?php

use yii\db\Migration;

/**
 * Class m201019_121655_create_table_drawings
 */
class m201019_121655_create_table_drawings extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%catalog_product_drawings}}', [
            'id'         => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'image'      => $this->string(),
            'image_hash' => $this->string(),
            'position'   => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-catalog_product_drawings-product_id', 'catalog_product_drawings', 'product_id');
        $this->addForeignKey('fk-catalog_product_drawings-product_id', 'catalog_product_drawings', 'product_id', 'catalog_products', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-catalog_product_drawings-product_id', 'catalog_product_drawings');
        $this->dropIndex('idx-catalog_product_drawings-product_id', 'catalog_product_drawings');
        $this->dropTable('{{%catalog_product_drawings}}}');
    }

}
