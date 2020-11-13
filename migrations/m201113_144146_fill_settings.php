<?php

use yii\db\Migration;

/**
 * Class m201113_144146_fill_settings
 */
class m201113_144146_fill_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand("INSERT INTO `setting` (`id`, `type`, `value`, `title`, `hash`, `description`, `hint`, `position`) VALUES
            ('phones', 'text', '+8 (800) 201 42 91\r\n+8 (920) 338 91 69\r\n510-110', 'Телефоны', NULL, 'Телефоны в шапке', 'Каждый телефон с новой строки', 1),
            ('video', 'string', 'https://www.youtube.com/watch?v=d3ri1ID5Ql4', 'Видео на главной', NULL, '', 'Ссылка на youtube видео', 3),
            ('vk', 'string', ' https://vk.com', 'Вконтакте', NULL, '', 'Ссылка', 2);
            COMMIT;"
        );
    }

    public function safeDown()
    {
        echo "m201113_144146_fill_settings cannot be reverted.\n";

        return false;
    }
}
