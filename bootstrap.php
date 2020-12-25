<?php
declare(strict_types=1);

require "vendor/autoload.php";
require "app/models/User.php";
require "app/controllers/Users.php";

namespace Models;
use Illuminate\Database\Capsule\Manager as Capsule;
use Controllers\Users;

defined("DBDRIVER")or define("DBDRIVER","mysql");
defined("DBHOST")or define("DBHOST","localhost");
defined("DBNAME")or define("DBNAME","lessons");
defined("DBUSER")or define("DBUSER","admin");
defined("DBPASS")or define("DBPASS","alexadmin");

class Database {
    function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
            "driver" => DBDRIVER,
            "host" => DBHOST,
            "database" => DBNAME,
            "username" => DBUSER,
            "password" => DBPASS,
            "charset" => "utf8",
            "collation" => "utf8_unicode_ci",
            "prefix" => "",
        ]);

        $capsule->bootEloquent();
    }
}

$dt = new Database();
