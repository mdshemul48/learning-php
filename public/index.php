<?php
include_once __DIR__ . "/../includes/autoload.php";

try {
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');


    $entryPoint = new \Ninja\EntryPoint($route, new \Ijdb\IjdbRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
    include __DIR__ . '/../templates/layout.html.php';
}
