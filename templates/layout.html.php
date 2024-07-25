<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jokes.css">
    <title><?= $title ?> | IJDB</title>
</head>

<body>
    <header>
        <h1>Internet Joke Database</h1>
    </header>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">Joke List</a></li>
            <li><a href="/joke/edit">Add a new joke</a></li>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>
    <footer>
        &copy; IJDB 2017
    </footer>
</body>

</html>