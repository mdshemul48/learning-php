<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;
use DateTime;

class Joke
{
    private DatabaseTable $authorTable;
    private DatabaseTable $jokeTable;

    public function __construct(DatabaseTable $jokeTable, DatabaseTable $authorTable)
    {
        $this->authorTable = $authorTable;
        $this->jokeTable = $jokeTable;
    }

    public function home()
    {
        return ["title" =>  "Home", "template" => "home.html.php"];
    }

    public function list()
    {
        $title = "Jokes List";

        $result = $this->jokeTable->findAll();
        $totalJokes = $this->jokeTable->total();

        foreach ($result as $joke) {
            $author = $this->authorTable->findById("id", $joke['authorid']);
            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        return [
            "title" => $title,
            "template" => "jokeList.html.php",
            "variables" => [
                "jokes" => $jokes,
                "totalJokes" => $totalJokes
            ]
        ];
    }

    public function edit()
    {
        if (isset($_POST["joke"])) {
            $joke = $_POST["joke"];
            $joke["authorid"] = 1;
            $joke["jokedate"] = new DateTime();
            $this->jokeTable->save($joke);

            header("Location: /joke/list");
        } else {
            if (isset($_GET["id"])) {
                $joke = $this->jokeTable->findById("id", $_GET["id"]);
            }

            $title = "Edit Joke";


            return [
                "title" => $title,
                "template" => "editjoke.html.php",
                "variables" => ['joke' => $joke ?? null]
            ];
        }
    }

    public function delete()
    {
        $this->jokeTable->delete($_POST["deletebtn"]);

        header("Location: /joke/list");
    }
}
