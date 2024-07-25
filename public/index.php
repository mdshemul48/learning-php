<?php
function loadTemplate($template, $variables = [])
{
    extract($variables);

    ob_start();
    include __DIR__ . "/../template/" . $template;
    return ob_get_clean();
}

try {
    include_once __DIR__ . "/../includes/DatabaseConnection.php";
    include_once __DIR__ . "/../classes/DatabaseTable.php";
    include_once __DIR__ . "/../controllers/JokeController.php";

    $autherTable = new DatabaseTable($pdo, "auther", "id");
    $jokeTable = new DatabaseTable($pdo, "joke", "id");
    $jokeController = new JokeController($autherTable, $jokeTable);

    $action = $_GET["action"] ?? "home";

    if ($action == strtolower($action)) {
        $page = $jokeController->$action();
    } else header("location: index.php?action=" . strtolower($action));

    $title = $page['title'];
    $output = loadTemplate($page["template"], $page["variables"]);
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}


include __DIR__ . "/../template/layout.html.php";
