<?php

use yii\db\Migration;

/**
 * Class m201020_114958_create_table_reviews
 */
class m201020_114958_create_table_reviews extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id'           => $this->primaryKey(),
            'type'         => $this->integer()->notNull(),
            'name'         => $this->string()->notNull(),
            'place'        => $this->string()->notNull(),
            'review'       => $this->text()->defaultValue(null),
            'image'        => $this->string(),
            'image_hash'   => $this->string(),
            'status'       => $this->integer()->defaultValue(0),
            'created_at'   => $this->integer()->notNull(),
            'updated_at'   => $this->integer()->notNull(),
            'product_id'   => $this->integer()->defaultValue(null),
            'portfolio_id' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex('idx-reviews-product_id', 'reviews', 'product_id');
        $this->addForeignKey('fk-reviews-product_id', 'reviews', 'product_id', 'catalog_products', 'id', 'CASCADE', 'RESTRICT');

        $this->createIndex('idx-reviews-portfolio_id', 'reviews', 'portfolio_id');
        $this->addForeignKey('fk-reviews-portfolio_id', 'reviews', 'portfolio_id', 'portfolios', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
    }

}
