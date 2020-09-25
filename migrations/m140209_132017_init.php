<?php

use yii\db\Migration;

class m140209_132017_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password_hash' => $this->string(60)->notNull(),
            'auth_key' => $this->string(32)->defaultValue(null),
            'confirmed_at' => $this->integer(11),
            'unconfirmed_email' => $this->string(255),
            'registration_ip' => $this->bigInteger(),
            'blocked_at' => $this->integer(11)->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('user_unique_email', '{{%users}}', 'email', true);

        $this->createTable('{{%profiles}}', [
            'user_id' => $this->primaryKey(),
            'name' => $this->string(255),
            'last_name' => $this->string(255),
        ], $tableOptions);

        $this->addForeignKey('fk_user_profile', '{{%profiles}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tokens}}', [
            'user_id' => $this->integer()->notNull(),
            'code' => $this->string(32)->notNull(),
            'created_at' => $this->string(11)->notNull(),
            'type' => $this->smallInteger(32)->notNull(),
        ], $tableOptions);

        $this->createIndex('token_unique', '{{%tokens}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk_user_token', '{{%tokens}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'RESTRICT');

        $this->insert('{{%users}}', [
            'created_at' => time(),
            'updated_at' => time(),
            'blocked_at' => null,
            'email' => 'manager@dancecolor.ru',
            'password_hash' => '$2y$13$iJkbOlZgYfzRddMquXGttOWCLK4AmDVUrkM1.wLbz8odk/.myEh7y',
            'confirmed_at' => time(),
        ]);
        
        $this->insert('{{%profiles}}', [
            'user_id' => 1,
            'name' => 'Dancecolor',
            'last_name' => '',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%profiles}}');
        $this->dropTable('{{%users}}');
        $this->dropTable('{{%tokens}}');
    }
}
