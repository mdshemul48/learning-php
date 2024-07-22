<?php


try {
    $title = "Jokes List";
    $pdo = new PDO("mysql:host=localhost;dbname=ijdb;charset=utf8", "ijdbuser", "mypassword");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "SELECT * FROM joke";
    $result = $pdo->query($sql);

    ob_start();
    include __DIR__ . "/../template/jokeList.php";
    $output = ob_get_clean();
} catch (PDOException $e) {
}

include __DIR__ . "/../template/layout.html.php";
