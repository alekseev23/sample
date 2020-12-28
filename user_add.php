<?php
declare(strict_types=1);

require "bootstrap.php";

// Проверка наличия аргумента
if ($argc != 2) {
    echo "Usage: user_add.php Username\n";
    return;
}
// Пробуем лобавить нового пользователя
try {
    $name = $argv[1];
    $arr = array(
        "name" => $name
    );
    $user = User::create($arr);
    // Выводим сообщение и id пользователя
    echo "User '{$name}' successfully added with id = {$user->id}\n";
}
catch (Throwable $t) { // Если есть проблема, то ругаемся
    echo $t->getMessage()."\n";
}
