<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

try {
    if (isset($_POST["joketext"])) {
        updateJoke($pdo, $_POST["jokeid"], $_POST["joketext"], 1);

        header("Location: jokeList.php");
    } else {
        $joke = getJoke($pdo, $_GET["id"]);
        $title = "Edit Joke";

        ob_start();
        include __DIR__ . "/../template/editjoke.html.php";
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . "/../template/layout.html.php";
