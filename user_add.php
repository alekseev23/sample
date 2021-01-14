<?php
/**
 * About file
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

declare(strict_types=1);

require "bootstrap.php";

// Проверка наличия аргумента
if ($argc != 2) {
    echo "Usage: user_add.php Username\n";
    return;
}
// Пробуем добавить нового пользователя
try {
    $name = $argv[1];
    $fields = ["name" => $name];
    $user = \Work\Models\User::create($fields);
    // Выводим сообщение и id пользователя
    echo "User '{$name}' successfully added with id = {$user->id}\n";
} catch (Throwable $t) { // Если есть проблема, то ругаемся
    echo $t->getMessage()."\n";
}

        echo "Help";
$a=1; $b=$a+1;
