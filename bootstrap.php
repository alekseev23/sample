<?php
declare(strict_types=1);
error_reporting( E_ALL );

require "vendor/autoload.php";
//require "src/models/User.php";

use Illuminate\Database\Capsule\Manager as Capsule;
//use Controllers\Users;
use Model\User;
//use Work\Model\User;

class Database {
    function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
            "driver" => "mysql",
            "host" => "localhost",
            "database" => "lessons",
            "username" => "admin",
            "password" => "alexadmin",
            "charset" => "utf8",
            "collation" => "utf8_unicode_ci",
            "prefix" => "",
        ]);

        $capsule->bootEloquent();
    }
}
$dt = new Database();


