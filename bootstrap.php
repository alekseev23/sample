<?php
declare(strict_types=1);

error_reporting(-1);

require "vendor/autoload.php";
require "src/Interfaces/ResponseInterface.php";
require "src/Interfaces/ControllerInterface.php";
require "src/Controllers/TaskController.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "lessons",
    "username" => "teacher",
    "password" => "123456",
    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => "",
]);
$capsule->bootEloquent();

