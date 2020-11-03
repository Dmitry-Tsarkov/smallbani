<?php

use yii\db\Migration;

/**
 * Class m201020_110341_create_portfolio_category
 */
class m201020_110341_create_portfolio_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%portfolio_category}}', [
            'id'    => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%portfolio_category}}}');
    }
}
