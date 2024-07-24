<?php


try {
    $title = "Jokes List";
    include_once __DIR__ . "/../includes/DatabaseConnection.php";
    include_once __DIR__ . "/../includes/DatabaseFunctions.php";

    $sql = "SELECT `joke`.`id`, `joketext`, `name`, `email` FROM `joke` INNER JOIN `auther` ON `joke`.`autherid` = `auther`.`id`";
    $jokes = $pdo->query($sql);
    $totalJokes = totalJokes($pdo);
    
    ob_start();
    include __DIR__ . "/../template/jokeList.php";
    $output = ob_get_clean();
} catch (PDOException $e) {
}

include __DIR__ . "/../template/layout.html.php";
