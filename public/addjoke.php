<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

if (isset($_POST["joketext"])) {
    try {
        $title = "Jokes List";

        insert($pdo, "joke", [
            'autherid' => 1,
            'jokeText' => $_POST['joketext'],
            'jokedate' => new DateTime()
        ]);

        header("Location: jokeList.php");
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'Add a new joke';
    ob_start();
    include __DIR__ . '/../template/addjoke.html.php';
    $output = ob_get_clean();
}
include __DIR__ . '/../template/layout.html.php';
