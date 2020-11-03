<?php

use yii\db\Migration;

/**
 * Class m190401_123611_page_element
 */
class m190401_123611_page_element extends Migration
{
    public function safeUp()
    {
        $this->createTable('page_element', [
            'id' => $this->primaryKey(),
            'page_id' => $this->string(255)->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->text()
        ]);

        $this->addForeignKey(
            'fk-page_element-pages',
            'page_element',
            'page_id',
            'pages',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-page_element-pages', 'page_element');
        $this->dropTable('page_element');
    }
}
