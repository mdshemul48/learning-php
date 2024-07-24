<?php
function processDates($fields)
{
    foreach ($fields as $key => $value) {
        if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d');
        }
    }
    return $fields;
}

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


function allJokes($database)
{
    $sql = "SELECT `joke`.`id`, `joketext`, `name`, `email` FROM `joke` INNER JOIN `auther` ON `joke`.`autherid` = `auther`.`id`";
    return query($database, $sql)->fetchAll();
}

function getJoke($database, $jokeId)
{
    $sql = "SELECT `joketext`, `id` FROM `joke` WHERE `id` = :id";
    return query($database, $sql, [':id' => $jokeId])->fetch();
}

function insertJoke($database, $fields)
{
    $query = 'INSERT INTO `joke` (';
    foreach ($fields as $key => $value) {
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach ($fields as $key => $value) {
        $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';

    $fields = processDates($fields);

    query($database, $query, $fields);
}

function updateJoke($database, $fields)
{
    $sql = "UPDATE `joke` SET ";
    foreach ($fields as $key => $value) {
        $sql .= "`$key` = :$key ,";
    }
    $sql = rtrim($sql, ",");
    $sql .= "WHERE `id` = :primaryKey";

    $fields["primaryKey"] = $fields['id'];
    query($database, $sql, $fields);
}


function deleteJoke($database, $jokeId)
{
    $sql = "DELETE FROM `joke` WHERE `id` = :id";
    query($database, $sql, [":id" => $jokeId]);
}
