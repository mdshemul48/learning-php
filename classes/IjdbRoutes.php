<?php


class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authersTable = new DatabaseTable($pdo, 'auther', 'id');


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
        }

        return $page;
    }
}
