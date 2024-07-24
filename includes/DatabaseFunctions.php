<?php


function query($database, $sql, $args = [])
{
    $q = $database->prepare($sql);
    $q->execute($args);
    return $q;
}

function totalJokes($database)
{
    $query = query($database, "SELECT COUNT(*) FROM `joke`;");
    return $query->fetch()[0];
}


function getJoke($database, $jokeId)
{
    $sql = "SELECT `joketext`, `id` FROM `joke` WHERE `id` = :id";
    return query($database, $sql, [':id' => $jokeId])->fetch();
}

function insertJoke($database, $joketext, $authorId)
{
    $sql = "INSERT INTO `joke` (`joketext`, `jokedate`, `autherid`) VALUES (:joketext, CURDATE(), :autherid)";

    $params = [":joketext" => $joketext, ":autherid" => $authorId];

    query($database, $sql, $params);
}

function updateJoke($database, $jokeId, $joketext, $authorId)
{
    $sql = "UPDATE `joke` SET `autherid` = :autherid, 
    `joketext` = :joketext WHERE `id` = :id";

    $params = [":autherid" => $authorId, ":joketext" => $joketext, ":id" => $jokeId];

    query($database, $sql, $params);
}
