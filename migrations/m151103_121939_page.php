<?php

use yii\db\Migration;

/**
 * Class m151103_121939_page
 */
class m151103_121939_page extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pages}}', [
            'id' => $this->string(50)->notNull()->unique(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'parent_id' => $this->string(50),
            'title' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'route' => $this->string(255),
            'content' => $this->text(),
            'content_bottom' => $this->text(),
            'meta_d' => $this->string(255),
            'meta_k' => $this->string(255),
            'meta_t' => $this->string(255),
            'h1' => $this->string(255),
            'image' => $this->string(500),
            'image_hash' => $this->string(255),
            'options_mask' => $this->integer()->defaultValue(0),
        ],
            $tableOptions);
        $this->addPrimaryKey('pk_id', 'pages', 'id');
        $this->insert('{{%pages}}', [
            'id' => 'root',
            'created_at' => time(),
            'updated_at' => time(),
            'parent_id' => 0,
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
            'title' => '',
            'alias' => '',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
