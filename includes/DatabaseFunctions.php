<?php

function totalJokes($database)
{
    $query = $database->prepare("SELECT COUNT(*) FROM `joke`;");
    $query->execute();
    return $query->fetch()[0];
}
