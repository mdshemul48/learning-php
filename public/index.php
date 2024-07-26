<?php

use Ninja\EntryPoint;
use Ijdb\IjdbRoutes;

include_once __DIR__ . "/../includes/autoload.php";

try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $method = $_SERVER["REQUEST_METHOD"];

    $entryPoint = new EntryPoint($route, $method, new IjdbRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
    include __DIR__ . '/../templates/layout.html.php';
}
