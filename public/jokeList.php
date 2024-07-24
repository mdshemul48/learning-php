<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

try {
    $title = "Jokes List";

    $jokes = allJokes($pdo);
    $totalJokes = totalJokes($pdo);

    ob_start();
    include __DIR__ . "/../template/jokeList.html.php";
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . "/../template/layout.html.php";
