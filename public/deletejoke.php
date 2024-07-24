<?php
if (isset($_POST["deletebtn"])) {
    try {
        include_once __DIR__ . "/../includes/DatabaseConnection.php";



        $sql = "DELETE FROM `joke` WHERE `id` = :jokeid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":jokeid", $_POST["deletebtn"]);
        $stmt->execute();

        header("Location: jokeList.php");
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in '
            . $e->getFile() . ':' . $e->getLine();

        include __DIR__ . "/../template/layout.html.php";
    }
}
