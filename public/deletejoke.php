<?php
if (isset($_POST["deletebtn"])) {
    try {
        include_once __DIR__ . "/../includes/DatabaseConnection.php";
        include_once __DIR__ . "/../includes/DatabaseFunctions.php";

        delete($pdo, "joke", $_POST["deletebtn"]);

        header("Location: jokeList.php");
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();

        include __DIR__ . "/../template/layout.html.php";
    }
}
