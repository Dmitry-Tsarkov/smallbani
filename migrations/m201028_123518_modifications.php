<?php

use yii\db\Migration;

/**y
 * Class m201028_123518_modifications
 */
class m201028_123518_modifications extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%modifications}}', [
            'id'        => $this->primaryKey(),
            'group_id'  => $this->integer()->defaultValue(null),
            'colour_id' => $this->integer()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-modifications-group_id',
            'modifications',
            'group_id'
        );

        $this->addForeignKey('fk-modifications-group_id',
            'modifications',
            'group_id',
            'colour_groups',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-modifications-colour_id',
            'modifications',
            'colour_id'
        );

        $this->addForeignKey(
            'fk-modifications-colour_id',
            'modifications',
            'colour_id',
            'colours',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }


    public function safeDown()
    {
        $this->dropTable('{{%modifications}}');
    }

}
