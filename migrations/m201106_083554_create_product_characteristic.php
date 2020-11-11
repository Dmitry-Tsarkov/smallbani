<?php

use yii\db\Migration;

/**
 * Class m201106_083554_create_product_characteristic
 */
class m201106_083554_create_product_characteristic extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%characteristics}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull(),
            'unit'          => $this->string()->notNull(),
            'type'          => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%characteristic_variants}}', [
            'id'                => $this->primaryKey(),
            'characteristic_id' => $this->integer()->defaultValue(null),
            'value'             => $this->string()->notNull(),

        ]);

        $this->createIndex(
            'idx-characteristic_variants-characteristic_id',
            'characteristic_variants',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-characteristic_variants-characteristic_id',
            'characteristic_variants',
            'characteristic_id',
            'characteristics',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createTable('{{%characteristic_values}}', [
            'id'                => $this->primaryKey(),
            'characteristic_id' => $this->integer()->defaultValue(null),
            'product_id'        => $this->integer()->defaultValue(null),
            'variant_id'        => $this->integer()->defaultValue(null),
            'value'             => $this->string()->defaultValue(null),
            'is_basic_set'      => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex(
            'idx-characteristic_values-characteristic_id',
            'characteristic_values',
            'characteristic_id'
        );

        $this->addForeignKey(
            'fk-characteristic_values-characteristic_id',
            'characteristic_values',
            'characteristic_id',
            'characteristics',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-characteristic_values-product_id',
            'characteristic_values',
            'product_id'
        );

        $this->addForeignKey(
            'fk-characteristic_values-product_id',
            'characteristic_values',
            'product_id',
            'catalog_products',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-characteristic_values-variant_id',
            'characteristic_values',
            'variant_id'
        );

        $this->addForeignKey(
            'fk-characteristic_values-variant_id',
            'characteristic_values',
            'variant_id',
            'characteristic_variants',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }


    public function safeDown()
    {
        $this->dropTable('{{%value}}');
        $this->dropTable('{{%variants}}');
        $this->dropTable('{{%product_characteristics}}');
    }

}
