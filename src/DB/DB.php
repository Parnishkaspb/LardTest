<?php

namespace Project\DB;

use PDO;
use PDOException;
use Exception;

class DB {
    private $pdo;
    private $host = 'localhost';
    private $username = 'u1560680_def';
    private $password = 'yPg36eyCi3Z6WIIl';
    private $database = 'u1560680_test_work';
    private $charset = 'utf8';

    protected function __construct() {
        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }


    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";

        $this->query($sql, $data);
        return $this->pdo->lastInsertId();
    }

    public function blastInsert($table, $data) {
        if (empty($data)) {
            return false;
        }

        $columns = implode(", ", array_keys($data[0]));
        $placeholders = array_fill(0, count($data), "(" . implode(", ", array_fill(0, count($data[0]), "?")) . ")");
        $values = [];

        foreach ($data as $row) {
            $values = array_merge($values, array_values($row));
        }

        $placeholders = implode(", ", $placeholders);
        $sql = "INSERT INTO $table ($columns) VALUES $placeholders";

        try {
            $this->query($sql, $values);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function update($table, $data, $condition) {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }
        $set = implode(", ", $set);
        $sql = "UPDATE $table SET $set WHERE $condition";

        $this->query($sql, $data);
    }

    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        $this->query($sql);
    }

    public function startTransaction() {
        $this->pdo->beginTransaction();
    }

    public function commitTransaction() {
        $this->pdo->commit();
    }

    public function rollBackTransaction() {
        $this->pdo->rollBack();
    }
}
