<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

try {
    if (isset($_POST["joketext"])) {
        update($pdo, "joke", [
            "id" => $_POST["jokeid"],
            "joketext" => $_POST["joketext"],
            "autherid" => 1
        ]);

        header("Location: jokeList.php");
    } else {
        $joke = findById($pdo, "joke", "id", $_GET["id"]);
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
