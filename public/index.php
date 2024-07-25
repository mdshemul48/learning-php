<?php

try {
    include_once __DIR__ . "/../includes/DatabaseConnection.php";
    include_once __DIR__ . "/../classes/DatabaseTable.php";
    include_once __DIR__ . "/../controllers/JokeController.php";

    $autherTable = new DatabaseTable($pdo, "auther", "id");
    $jokeTable = new DatabaseTable($pdo, "joke", "id");
    $jokeController = new JokeController($autherTable, $jokeTable);

    $action = $_GET["action"] ?? "home";
    $page = $jokeController->$action();

    $title = $page['title'];
    if (isset($page["variables"])) {
        extract($page["variables"]);
    }

    ob_start();
    include __DIR__ . "/../template/" . $page["template"];
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}


include __DIR__ . "/../template/layout.html.php";
