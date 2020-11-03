<?php

use yii\db\Migration;

/**
 * Class m201019_144704_product_client_photos
 */
class m201019_144704_product_client_photos extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%catalog_product_client_photos}}', [
            'id'         => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'image'      => $this->string(),
            'image_hash' => $this->string(),
            'position'   => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-catalog_product_client_photos-product_id', 'catalog_product_client_photos', 'product_id');
        $this->addForeignKey('fk-catalog_product_client_photos-product_id', 'catalog_product_client_photos', 'product_id', 'catalog_products', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-catalog_product_client_photos-product_id', 'catalog_product_client_photos');
        $this->dropIndex('idx-catalog_product_client_photos-product_id', 'catalog_product_client_photos');
        $this->dropTable('{{%catalog_product_client_photos}}}');
    }

}
