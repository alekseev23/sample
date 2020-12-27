<?php

declare(strict_types=1);

require "bootstrap.php";

if ($argc!=2) {
    echo "Usage: user_add.php Username\n";
    return;
}
try {
    $user = Controllers\Users::create_user($argv[1]);
    echo "User '".$argv[1]."' successfully added with id=".$user->id."\n";
}
catch (Throwable $t) {
    echo "User exists: ".$argv[1]."\n";
}
catch (Exception $e) {
    echo "EEE\n";
}
