<?php

require_once('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    //'cache' => 'cache'
]);

    $x=rand(0,100);
    $y=rand(0,100);
    $y=rand(0,100);

echo $twig->render('XYZ.html', ['X' => $x, 'Y' => $y, 'Z' => $z]);
