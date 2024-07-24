<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

try {
    $title = "Jokes List";

    $result = findAll($pdo, "joke");
    $totalJokes = total($pdo, "joke");

    foreach ($result as $joke) {
        $auther = findById($pdo, "auther", "id", $joke['autherid']);
        $jokes[] = [
            'id' => $joke['id'],
            'joketext' => $joke['joketext'],
            'jokedate' => $joke['jokedate'],
            'name' => $auther['name'],
            'email' => $auther['email']
        ];;
    }

    ob_start();
    include __DIR__ . "/../template/jokeList.html.php";
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . "/../template/layout.html.php";
