# Sql Notes

```sql

INSERT INTO `joke` (`joketext`, `date`) VALUES ('!false - it\'s funny because it\'s true', "2012-04-01") -- insert into the table.


SELECT * FROM `joke` -- get everything from the table

SELECT `id`, `jokedate` FROM joke -- select specific column from the table.

SELECT `id`, LEFT(joketext, 20), jokedate FROM `joke`; -- the function LEFT is used to limit text for joketext

SELECT COUNT(`id`) FROM joke; -- the count function here returns count of the table row.

SELECT COUNT(`id`) FROM `joke` WHERE `jokedate` >= "1212-12-12"; -- with WHERE we can search within the table with various conditions.

SELECT `joketext` FROM `joke` WHERE
`joketext` LIKE "%knock%" AND
`jokedate` >= "2017-04-01" AND
`jokedate` < "2017-05-01"; -- Search with like and multiple condition

UPDATE `joke` SET `jokedate` = "2018-04-01" WHERE id = "1"; -- update row

DELETE FROM `joke` WHERE  `joketext` LIKE "%programmer%"; -- delete row.

```

# php notes

```php

$pdo = new PDO("mysql:host=localhost;database=ijdb;charset=utf8", "ijdbuser", "mypassword");  // connect database

$sql = 'SELECT * FROM `joke`'; $pdo->exec($sql); // run sql command


$sql = "SELECT `joketext` FROM `joke`;"; $result = $pdo->query($sql); // run query and get result object.
// $pdo->query($sql) returns a results set. Form of a PDOStatement object

while ($row = $result->fetch()) { // looping through rows.
        echo $row["joketext"] . '<br>';
}


 <?php if (isset($error)) : ?>      // php also support template in php html
        <h1><?php echo $error; ?></h1>
    <?php else : ?>
        <?php foreach ($jokes as $joke) : ?>
            <h3><?php echo $joke; ?></h3>
        <?php endforeach ?>
    <?php endif ?>




// both way is exactly same.
while ($row = $result->fetch()) {
    $jokes[] = $row["joketext"];
}
foreach ($result as $row) {
    $jokes[] = $row["joketext"];
}


<?php echo $something?> can be written as <?=$something?>

ob_start(); // with this we can capture the echo and print from the output buffer.
include __DIR__ . '/../templates/home.html.php';
$output = ob_get_clean();

htmlspecialchars($_POST["firstname"], ENT_QUOTES, "UTF-8") // serialize data
```
