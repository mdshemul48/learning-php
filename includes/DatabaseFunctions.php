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

function total($database, $tableName)
{
    $query = query($database, "SELECT COUNT(*) FROM `$tableName`;");
    return $query->fetch()[0];
}


function findAll($database, $tableName)
{
    $sql = "SELECT * FROM `$tableName`";
    return query($database, $sql)->fetchAll();
}

function findById($database, $tableName, $fieldName, $id)
{
    $sql = "SELECT * FROM `$tableName` WHERE `$fieldName` = :id";
    return query($database, $sql, [':id' => $id])->fetch();
}

function insert($database, $tableName, $fields)
{
    $query = "INSERT INTO `$tableName` (";

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

function update($database, $tableName, $id, $fields)
{
    $sql = "UPDATE `$tableName` SET ";
    foreach ($fields as $key => $value) {
        $sql .= "`$key` = :$key ,";
    }
    $sql = rtrim($sql, ",");
    $sql .= "WHERE `id` = :primaryKey";

    $fields["primaryKey"] = $id;
    query($database, $sql, $fields);
}


function delete($database, $tableName, $jokeId)
{
    $sql = "DELETE FROM `$tableName` WHERE `id` = :id";
    query($database, $sql, [":id" => $jokeId]);
}


function save($database, $tableName, $primaryKey, $record)
{
    try {
        if ($record[$primaryKey] == "") $record[$primaryKey] = null;
        insert($database, $tableName, $record);
    } catch (PDOException $e) {
        update($database, $tableName, $record[$primaryKey], $record);
    }
}
