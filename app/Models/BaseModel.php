<?php

namespace App\Models;

use App\Database\Database;

abstract class BaseModel {
    protected Database $db;
    protected string $table;
    protected array $fillable = [];
    protected array $hidden = []; // Fields to hide from queries

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Get table name
     */
    public function getTable(): string {
        return $this->table ?? strtolower(basename(str_replace('\\', '/', static::class))) . 's';
    }

    /**
     * Get all records
     */
    public static function all(): array {
        return (new static())->query("SELECT * FROM " . (new static())->getTable());
    }

    /**
     * Find record by ID
     */
    public static function find(int $id): ?array {
        return (new static())->queryOne(
            "SELECT * FROM " . (new static())->getTable() . " WHERE id = ?",
            [$id]
        );
    }

    /**
     * Find by custom column
     */
    public static function findBy(string $column, $value): ?array {
        return (new static())->queryOne(
            "SELECT * FROM " . (new static())->getTable() . " WHERE {$column} = ?",
            [$value]
        );
    }

    /**
     * Where query
     */
    public function where(string $column, $value): array {
        return $this->query(
            "SELECT * FROM " . $this->getTable() . " WHERE {$column} = ?",
            [$value]
        );
    }

    /**
     * Create new record
     */
    public static function create(array $data): int {
        $instance = new static();
        return $instance->db->insert(
            $instance->getTable(),
            $instance->filterFillable($data)
        );
    }

    /**
     * Update record
     */
    public function update(array $data): int {
        return $this->db->update(
            $this->getTable(),
            $this->filterFillable($data),
            ['id' => $this->id ?? null]
        );
    }

    /**
     * Delete record
     */
    public function delete(): int {
        return $this->db->delete(
            $this->getTable(),
            ['id' => $this->id ?? null]
        );
    }

    /**
     * Filter data to only include fillable fields
     */
    protected function filterFillable(array $data): array {
        if (empty($this->fillable)) {
            return $data;
        }
        return array_intersect_key($data, array_flip($this->fillable));
    }

    /**
     * Execute custom query
     */
    protected function query(string $sql, array $params = []): array {
        return $this->db->query($sql, $params);
    }

    /**
     * Execute custom query returning one row
     */
    protected function queryOne(string $sql, array $params = []): ?array {
        return $this->db->queryOne($sql, $params);
    }

    /**
     * Get attribute value
     */
    public function __get(string $name) {
        return $this->$name ?? null;
    }

    /**
     * Set attribute value
     */
    public function __set(string $name, $value): void {
        $this->$name = $value;
    }
}
