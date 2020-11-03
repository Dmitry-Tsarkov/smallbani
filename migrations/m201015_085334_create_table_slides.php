<?php

use yii\db\Migration;

/**
 * Class m201015_085334_create_table_slides
 */
class m201015_085334_create_table_slides extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%slides}}', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string()->notNull(),
            'image'         => $this->string()->defaultValue(null),
            'image_hash'    => $this->string()->defaultValue(null),
            'is_active'     => $this->boolean()->defaultValue(false),
            'position'      => $this->integer()->notNull(),
            'link_text'     => $this->string()->defaultValue(null),
            'link_href'     => $this->string()->defaultValue(null),
            'link_is_blank' => $this->boolean()->defaultValue(false),
            'active_from'   => $this->integer()->defaultValue(null),
            'active_to'     => $this->integer()->defaultValue(null),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%slides}}');
    }

}
