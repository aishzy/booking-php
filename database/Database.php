<?php

namespace App\Database;

use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct() {
        $config = require BASE_PATH . '/config/database.php';
        
        try {
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
            
            $this->connection = new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }

    public function query(string $sql, array $params = []): array {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function queryOne(string $sql, array $params = []): ?array {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() ?: null;
    }

    public function execute(string $sql, array $params = []): int {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function insert(string $table, array $data): int {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        
        return $this->execute($sql, array_values($data));
    }

    public function update(string $table, array $data, array $where): int {
        $setClause = implode(', ', array_map(fn($key) => "{$key} = ?", array_keys($data)));
        $whereClause = implode(' AND ', array_map(fn($key) => "{$key} = ?", array_keys($where)));
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$whereClause}";
        $values = array_merge(array_values($data), array_values($where));
        
        return $this->execute($sql, $values);
    }

    public function delete(string $table, array $where): int {
        $whereClause = implode(' AND ', array_map(fn($key) => "{$key} = ?", array_keys($where)));
        $sql = "DELETE FROM {$table} WHERE {$whereClause}";
        
        return $this->execute($sql, array_values($where));
    }

    public function lastInsertId(): string {
        return $this->connection->lastInsertId();
    }
}