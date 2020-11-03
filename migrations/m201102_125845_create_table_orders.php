<?php

use yii\db\Migration;

/**
 * Class m201102_125845_create_table_orders
 */
class m201102_125845_create_table_orders extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id'            => $this->primaryKey(),
            'product_id'    => $this->integer()->defaultValue(null),
            'phone'         => $this->string()->notNull(),
            'name'          => $this->string()->notNull(),
            'product_title' => $this->string()->notNull(),
            'status'        => $this->integer()->defaultValue(0),
            'created_at'    => $this->integer()->notNull(),
            'updated_at'    => $this->integer()->notNull(),

        ]);

        $this->createIndex(
            'idx-orders-product_id',
            'orders',
            'product_id'
        );

        $this->addForeignKey(
            'fk-orders-product_id',
            'orders',
            'product_id',
            'catalog_products',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }

}
