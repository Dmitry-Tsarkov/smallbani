<?php

use yii\db\Migration;

/**
 * Class m201028_123457_create_colour_groups
 */
class m201028_123457_create_colour_groups extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%colour_groups}}', [
            'id'         => $this->primaryKey(),
            'product_id' => $this->integer()->defaultValue(null),
            'title'      => $this->string()->notNull(),
            'position'   => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-colour_groups-product_id',
            'colour_groups',
            'product_id'
        );

        $this->addForeignKey(
            'fk-colour_groups-product_id',
            'colour_groups',
            'product_id',
            'catalog_products',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }



    public function safeDown()
    {
        $this->dropTable('{{%colour_groups}}');
    }

}
