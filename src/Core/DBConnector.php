<?php

namespace Core;

use Exception;
use PDO;

class DBConnector
{
    private PDO $db;

    public function __construct(string $host, string $username, string $password, string $databaseName)
    {
        /* connect to DB */
        try {
            $this->db = new PDO('mysql:host=' . $host . ';dbname=' . $databaseName, $username, $password);
        } catch (Exception $e) {
            die('DB error: ' . $e->getMessage() . "\n");
        }
    }

    public function exec(string $query): bool|int
    {
        return $this->db->exec($query);
    }

    public function insertPreparedQuery(string $query, array $values): bool
    {
        $stmt = $this->db->prepare($query);
        return $stmt->execute($values);
    }

    public function fetchAll(string $query, array $arguments = []): bool|array
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute($arguments);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
