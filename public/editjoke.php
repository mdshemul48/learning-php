<?php
include_once __DIR__ . "/../includes/DatabaseConnection.php";
include_once __DIR__ . "/../includes/DatabaseFunctions.php";

try {
    if (isset($_POST["joke"])) {
        $joke = $_POST["joke"];
        $joke["autherid"] = 1;
        $joke["jokedate"] = new DateTime();

        save($pdo, "joke", 'id', $joke);

        header("Location: jokeList.php");
    } else {
        if (isset($_GET["id"])) {
            $joke = findById($pdo, "joke", "id", $_GET["id"]);
        }

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
