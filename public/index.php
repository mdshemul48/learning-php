<?php
function loadTemplate($templateFileName, $variables = [])
{
    extract($variables);
    ob_start();
    include __DIR__ . '/../templates/' . $templateFileName;
    return ob_get_clean();
}

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authersTable = new DatabaseTable($pdo, 'auther', 'id');

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    if ($route == "") {
        include __DIR__ . '/../classes/controllers/JokeController.php';
        $controller = new JokeController(
            $jokesTable,
            $authersTable
        );
        $page = $controller->home();
    } else if ($route == strtolower($route)) {
        if ($route === 'joke/list') {
            include __DIR__ . '/../classes/controllers/JokeController.php';
            $controller = new JokeController(
                $jokesTable,
                $authersTable
            );
            $page = $controller->list();
        } elseif ($route === 'joke/home') {
            include __DIR__ .
                '/../classes/controllers/JokeController.php';
            $controller = new JokeController(
                $jokesTable,
                $authersTable
            );
            $page = $controller->home();
        } elseif ($route === 'joke/edit') {
            include __DIR__ .
                '/../classes/controllers/JokeController.php';
            $controller = new JokeController(
                $jokesTable,
                $authersTable
            );
            $page = $controller->edit();
        } elseif ($route === 'joke/delete') {
            include __DIR__ .
                '/../classes/controllers/JokeController.php';
            $controller = new JokeController(
                $jokesTable,
                $authersTable
            );
            $page = $controller->delete();
        } elseif ($route === 'register') {
            include __DIR__ .
                '/../classes/controllers/RegisterController.php';
            $controller = new RegisterController($authersTable);
            $page = $controller->showForm();
        }
    } else {
        http_response_code(301);
        header('location: index.php?route=' . strtolower($route));
    }

    $title = $page['title'];
    if (isset($page['variables'])) {
        $output = loadTemplate(
            $page['template'],
            $page['variables']
        );
    } else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
        . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
