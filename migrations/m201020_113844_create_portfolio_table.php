<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%portfolio}}`.
 */
class m201020_113844_create_portfolio_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%portfolios}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'alias'       => $this->string()->notNull(),
            'status'      => $this->integer()->notNull(),
            'category_id' => $this->integer()->defaultValue( null),
            'description' => $this->text()->defaultValue(null),
            'youtube_url' => $this->string()->defaultValue(null),
            'created_at'  => $this->integer()->notNull(),
            'updated_at'  => $this->integer()->notNull(),
            'meta_t'       => $this->string()->defaultValue(null),
            'meta_d'       => $this->string()->defaultValue(null),
            'meta_k'       => $this->string()->defaultValue(null),
            'h1'           => $this->string()->defaultValue(null),
        ]);

        $this->createIndex('idx-portfolios-category_id', 'portfolios', 'category_id');
        $this->addForeignKey('fk-portfolios-category_id', 'portfolios', 'category_id', 'portfolio_category', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%portfolio_images}}', [
            'id'           => $this->primaryKey(),
            'portfolio_id' => $this->integer()->defaultValue(null),
            'image'        => $this->string(),
            'image_hash'   => $this->string(),
            'position'     => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-portfolio_images-portfolio_id', 'portfolio_images', 'portfolio_id');
        $this->addForeignKey('fk-portfolio_images-portfolio_id', 'portfolio_images', 'portfolio_id', 'portfolios', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-portfolios-category_id', 'portfolios');
        $this->dropIndex('idx-portfolios-category_id', 'portfolios');
        $this->dropTable('{{%portfolios}}}');

        $this->dropForeignKey('fk-portfolio_images-portfolio_id', 'portfolio_images');
        $this->dropIndex('idx-portfolio_images-portfolio_id', 'portfolio_images');
        $this->dropTable('{{%portfolio_images}}}');
    }
}
