<?php

declare(strict_types=1);

require "bootstrap.php";

if ($argc>1) $users = Controllers\Users::show_users_with_parameter($argv[1]);
else $users = Controllers\Users::show_users();
foreach ($users as $user) {
    echo $user->name."\n";
}
