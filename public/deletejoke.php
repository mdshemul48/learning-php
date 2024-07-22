<?php
if (isset($_POST["deletebtn"])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ijdb;charset=utf8", "ijdbuser", "mypassword");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
