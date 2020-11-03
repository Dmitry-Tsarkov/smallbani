<?php

use yii\db\Migration;

/**
 * Class m201028_123515_create_colours
 */
class m201028_123515_create_colours extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%colours}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'hex'   => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%colours}}');
    }

}
