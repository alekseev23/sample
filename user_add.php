<?php

declare(strict_types=1);

require "config.php";
require "vendor/autoload.php";
require "app/models/Database.php";
require "app/models/User.php";
require "app/controllers/Users.php";

use Models\Database;
use Controllers\Users;

$dt = new Database();
$user = Users::create_user($argv[1]);
$users = Users::show_users();

foreach($users as $user) {
    echo $user->name."<br>\n";
}