<?php
declare(strict_types=1);

require "bootstrap.php";

// Проверка наличия аргумента
if ($argc > 1) {
    $pattern = $argv[1];
    $users = Work\Model\User::where('name', 'like', $pattern)->get();
} else { // Показать всех пользователей
    $users = Work\Model\User::all();
}
// Вывод списка пользователей
foreach ($users as $user) {
    echo "{$user->name}\n";
}
