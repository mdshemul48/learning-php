<?php

class DatabaseTable
{
    private PDO $pdo;
    private string $tableName;
    private string $primaryKey;

    public function __construct(PDO $pdo, string $table, string $primaryKey)
    {
        $this->pdo = $pdo;
        $this->tableName = $table;
        $this->primaryKey = $primaryKey;
    }
    private function processDates($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    private function query($sql, $args = [])
    {
        $q = $this->pdo->prepare($sql);
        $q->execute($args);
        return $q;
    }

    public function total()
    {
        $query = $this->query("SELECT COUNT(*) FROM `$this->tableName`;");
        return $query->fetch()[0];
    }


    public function findAll()
    {
        $sql = "SELECT * FROM `$this->tableName`";
        return $this->query($sql)->fetchAll();
    }

    public function findById($fieldName, $id)
    {
        $sql = "SELECT * FROM `$this->tableName` WHERE `$fieldName` = :id";
        return $this->query($sql, [':id' => $id])->fetch();
    }

    public function insert($fields)
    {
        $query = "INSERT INTO `$this->tableName` (";

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

        $fields = $this->processDates($fields);

        $this->query($query, $fields);
    }

    public function update($id, $fields)
    {
        $sql = "UPDATE `$this->tableName` SET ";
        foreach ($fields as $key => $value) {
            $sql .= "`$key` = :$key ,";
        }
        $sql = rtrim($sql, ",");
        $sql .= "WHERE `id` = :primaryKey";

        $fields["primaryKey"] = $id;
        $fields = $this->processDates($fields);
        $this->query($sql, $fields);
    }


    public function delete($jokeId)
    {
        $sql = "DELETE FROM `$this->tableName` WHERE `id` = :id";
        $this->query($sql, [":id" => $jokeId]);
    }


    public function save($record)
    {
        try {
            if ($record[$this->primaryKey] == "") $record[$this->primaryKey] = null;
            $this->insert($record);
        } catch (PDOException $e) {
            $this->update($record[$this->primaryKey], $record);
        }
    }
}
