<?php

use yii\db\Migration;

/**
 * Class m201102_135927_create_table_order_modifications
 */
class m201102_135927_create_table_order_modifications extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%order_modifications}}', [
            'id'                        => $this->primaryKey(),
            'order_id'                  => $this->integer()->defaultValue(null),
            'modification_id'           => $this->integer()->defaultValue(null),
            'modification_title'        => $this->string()->notNull(),
            'modification_colour_title' => $this->string()->notNull(),
            'modification_colour_hex'   => $this->string()->notNull(),

        ]);

        $this->createIndex(
            'idx-order_modifications-order_id',
            'order_modifications',
            'order_id'
        );

        $this->addForeignKey(
            'fk-order_modifications-order_id',
            'order_modifications',
            'order_id',
            'orders',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-order_modifications-modification_id',
            'order_modifications',
            'modification_id'
        );

        $this->addForeignKey(
            'fk-order_modifications-modification_id',
            'order_modifications',
            'modification_id',
            'modifications',
            'id',
            'SET NULL',
            'RESTRICT'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%order_modifications}}');
    }

}
