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
            ('adress', 'html', '<p class=\"contact__address\" style=\"box-sizing: inherit; font-weight: 700; font-size: 30px; line-height: 34px; color: rgb(48, 48, 48); margin-bottom: 10px; font-family: GTWalsheimPro, sans-serif;\">г.Смоленск</p>\r\n\r\n<p class=\"contact__title\" style=\"box-sizing: inherit; font-weight: 700; font-size: 20px; line-height: 23px; color: rgb(48, 48, 48); margin: 0px; font-family: GTWalsheimPro, sans-serif;\">пос. Тихвинка, 69</p>\r\n\r\n<p class=\"contact__title\" style=\"box-sizing: inherit; font-weight: 700; font-size: 20px; line-height: 23px; color: rgb(48, 48, 48); margin: 0px; font-family: GTWalsheimPro, sans-serif;\">пос. Тихвинка 10</p>\r\n\r\n<p class=\"contact__subtitle\" style=\"box-sizing: inherit; font-size: 15px; line-height: 15px; color: rgb(48, 48, 48); margin: 0px; font-family: GTWalsheimPro, sans-serif;\">(рядом с оптовым продуктовым рынком<br style=\"box-sizing: inherit;\" />\r\nи остановкой Аэропорт)</p>\r\n', 'Адрес', NULL, '', '', 6),
            ('facebook', 'string', 'https://ru-ru.facebook.com/', 'Фейсбук', NULL, '', 'Ссылка на facebook', 4),
            ('odnoklassniki', 'string', 'https://ok.ru/', 'Одноклассники', NULL, '', 'Ссылка на Одноклассники', 5),
            ('phones', 'text', '+8 (800) 201 42 91\r\n+8 (920) 338 91 69\r\n510-110', 'Телефоны', NULL, 'Телефоны в шапке', 'Каждый телефон с новой строки', 1),
            ('post', 'string', 'https://mail.yandex.ru/', 'Почта', NULL, '', 'Ссылка на почту', 7),
            ('video', 'string', 'https://www.youtube.com/watch?v=d3ri1ID5Ql4', 'Видео на главной', NULL, '', 'Ссылка на youtube видео', 3),
            ('vk', 'string', ' https://vk.com', 'Вконтакте', NULL, '', 'Ссылка', 2);
            COMMIT;"
        )->execute();
    }

    public function safeDown()
    {
        echo "m201113_144146_fill_settings cannot be reverted.\n";

        return false;
    }
}
