<?php

/**
 * @var app\modules\user\models\User $user
 * @var app\modules\user\models\Token $token
 */

?>

Здравтсвуйте,

Вы запросили смену пароля на сайте <?= Yii::$app->name ?>.
Чтобы восстановить пароль, нажмите на ссылку ниже.

<?= $token->url ?>

Если вы не можете нажать на ссылку, скопируйте ее и вставте в адресную строку вашего браузера.
P.S. Если вы получили это сообщение по ошибке, просто удалите его.