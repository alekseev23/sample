<?php

require_once('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader,[
    //'cache' => 'cache'
]);

$X=rand(0,100);
$Y=rand(0,100);
$Z=rand(0,100);

echo $twig->render('XYZ.html', ['X' => $X, 'Y' => $Y, 'Z' => $Z]);


