<?php
declare(strict_types=1);

require "bootstrap.php";

if ($argc != 2) {
    echo "Usage: user_add.php Username\n";
    return;
}

$dt = new Work\Database();

try {
    $name = $argv[1];
    //$user = Controllers\Users::create_user($name);
    $user = User::create($name);
    echo "User '{$name}' successfully added with id= {$user->id}\n";
}
catch (Throwable $t) {
    //echo "User exists: ".$argv[1]."\n";
    echo "Error\n";
}
