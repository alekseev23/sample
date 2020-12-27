<?php
declare(strict_types=1);

require "bootstrap.php";

$users = Controllers\Users::show_users();
foreach ($users as $user) {
    echo $user->name."\n";
}
