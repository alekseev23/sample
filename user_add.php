<?php

declare(strict_types=1);

require "bootstrap.php";

use Models\Database;
use Controllers\Users;

$dt = new Database();
$user = Users::create_user($argv[1]);
$users = Users::show_users();

foreach($users as $user) {
    echo $user->name."<br>\n";
}
