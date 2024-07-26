<?php

namespace Ijdb;

use Ijdb\Controllers\Joke;
use Ijdb\Controllers\Register;

class IjdbRoutes
{
    public function callAction($route)
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
        $authersTable = new \Ninja\DatabaseTable($pdo, 'auther', 'id');


        if ($route == "") {
            $controller = new Joke(
                $jokesTable,
                $authersTable
            );
            $page = $controller->home();
        } else if ($route == strtolower($route)) {
            if ($route === 'joke/list') {
                $controller = new Joke(
                    $jokesTable,
                    $authersTable
                );
                $page = $controller->list();
            } elseif ($route === 'joke/home') {
                $controller = new Joke(
                    $jokesTable,
                    $authersTable
                );
                $page = $controller->home();
            } elseif ($route === 'joke/edit') {
                $controller = new Joke(
                    $jokesTable,
                    $authersTable
                );
                $page = $controller->edit();
            } elseif ($route === 'joke/delete') {
                $controller = new Joke(
                    $jokesTable,
                    $authersTable
                );
                $page = $controller->delete();
            } elseif ($route === 'register') {
                $controller = new Register($authersTable);
                $page = $controller->showForm();
            }
        }

        return $page;
    }
}
