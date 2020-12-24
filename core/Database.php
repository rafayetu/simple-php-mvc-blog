<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    /**
     * Database constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    public function prepare($sql, $data)
    {
        $statement = $this->pdo->prepare($sql);
        foreach ($data as $field){
            $statement->bindValue(":$field->name", $field->getDbValue());
        }
        return $statement;
    }


    public function insertIntoTable(string $tableName, array $data, array $onDuplicateKeyUpdateColumns = [])
    {
        $columns = array_map(fn($k) => "$k->name", $data);
        $placeholders = array_map(fn($k) => ":$k->name", $data);
        $onDuplicateKeyStatement = count($onDuplicateKeyUpdateColumns) ? implode(", ", array_map(
            fn($k) => "$k->name=VALUES($k->name)", $onDuplicateKeyUpdateColumns)) : "id=id";
        $statement = $this->prepare("INSERT INTO $tableName (" . implode(", ", $columns) . ")
                                    VALUES (" . implode(", ", $placeholders) . ")
                                    ON DUPLICATE KEY UPDATE $onDuplicateKeyStatement", $data);
        $statement->execute();
    }

    public function selectFromTableSearchArray(string $tableName, array $searchQuery = null, array $columns = null)
    {
        $columnKeys = $columns ? array_map(fn($k) => "$k->name", $columns) : ["*"];
        $searchQueryKeys = $searchQuery ? array_map(fn($k) => "$k->name=:$k->name", $columns) : ["1"];
        $statement = $this->prepare("SELECT ".implode(", ", $columnKeys)." FROM $tableName 
                                    WHERE ". implode(" AND ", $searchQueryKeys), $searchQuery);
        $statement->execute();
        return $statement;
    }

    public function selectObject(string $tableName, array $searchQuery = null, array $columns = null)
    {
        $statement = $this->selectFromTableSearchArray($tableName, $searchQuery, $columns);
        return $statement->fetchObject();
    }
    public function selectResult(string $tableName, array $searchQuery = null, array $columns = null)
    {
        $statement = $this->selectFromTableSearchArray($tableName, $searchQuery, $columns);
        return $statement->fetchAll();
    }

}