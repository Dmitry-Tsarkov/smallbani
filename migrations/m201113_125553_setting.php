<?php

use yii\db\Migration;

/**
 * Class m201113_125553_setting
 */
class m201113_125553_setting extends Migration
{

    public function safeUp()
    {
        $this->createTable('setting', [
            'id'          => $this->string(255)->unique()->notNull(),
            'type'        => $this->string(255),
            'value'       => $this->text(),
            'title'       => $this->string(255),
            'hash'        => $this->string(255),
            'description' => $this->text(),
            'hint'        => $this->text(),
            'position'    => $this->integer(),
        ]);
        $this->addPrimaryKey('pk_id', 'setting', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('setting');
    }

}
