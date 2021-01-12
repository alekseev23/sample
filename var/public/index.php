<?php
declare(strict_types=1);

require '../../bootstrap.php';

$controller=new TaskController();
$controller->process();
echo $controller->getResult();
