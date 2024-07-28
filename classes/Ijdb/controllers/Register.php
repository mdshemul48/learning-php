<?php

namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Register
{

    private DatabaseTable $authorTable;

    public function __construct(DatabaseTable $authorTable)
    {
        $this->authorTable = $authorTable;
    }

    public function registrationForm()
    {
        return [
            "title" => "Register an Account",
            "template" => "register.html.php"
        ];
    }
    public function success()
    {
        return [
            "title" => "Registration Successful",
            "template" => "registersuccess.html.php"
        ];
    }

    public function registerUser()
    {
        $author = $_POST["author"];

        $valid = true;
        $errors = [];
        if (empty("name")) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }

        if (empty($author['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } else if (filter_var($author["email"], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = "Email address is not valid";
        }

        if (empty($author['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }

        if (count($this->authorTable->find("email", $author["email"])) > 0) {
            $valid = false;
            $errors[] = "Email already exist";
        }

        if ($valid) {

            $author["password"] = password_hash($author["password"], PASSWORD_DEFAULT);

            $this->authorTable->save($author);
            header('Location: /author/success');
        } else {
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                "variables" => [
                    "errors" => $errors,
                    "author" => $author
                ]
            ];
        }
    }
}
