<?php
declare(strict_types=1);

error_reporting(-1);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Moscow');
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Work\Listeners\DemoListener;

// init event dispatcher
$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

// register listener for the 'demo.event' event
$listener = new DemoListener();
$dispatcher->addListener('demo.event', array($listener, 'onDemoEvent'));

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

// Connecting to Redis server on localhost
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
