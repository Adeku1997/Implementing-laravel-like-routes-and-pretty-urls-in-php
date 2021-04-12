<?php

namespace Models;

use Exception;
use mysqli;
use mysqli_result;

/**
 * Class Model
 * @package Models
 */
abstract class Model
{
    protected string $tableName;
    /**
     * @var mysqli Database connection.
     */
    private mysqli $db;

    public function __construct()
    {
        require "../db.php";

        $this->db = $conn;

        $this->setTableName();
    }

    /**
     * Set the table-name for the model.
     */
    abstract protected function setTableName(): void;

    /**
     * Fetch a row from table using the id.
     *
     * @param int $id
     * @return $this|null
     */
    public function find(int $id): ?self
    {
        return $this->buildResult($this->buildQuery('id', $id));
    }

    /**
     * Build result from query.
     *
     * @param bool|mysqli_result $query
     * @return $this|null
     */
    private function buildResult($query): ?self
    {
        $result = $query->fetch_assoc();

        if (!$result || !count($result)) {
            return null;
        }

        $this->setAttributes($result);

        return $this;
    }

    /**
     * Set the attributes of the model instance.
     *
     * @param array $attributes
     */
    abstract protected function setAttributes(array $attributes): void;

    /**
     * Build query with where clause.
     *
     * @param $column
     * @param $value
     * @return bool|mysqli_result
     */
    private function buildQuery($column, $value)
    {
        return $this->db->query(/** @lang text */ "Select * from {$this->tableName} where $column = '{$value}'");
    }

    /**
     * Fetch a result using a column asides 'id'.
     *
     * @param string $columnName
     * @param int|string $value
     * @return $this|null
     */
    public function fetchWithCondition(string $columnName, $value): ?self
    {
        $result = $this->buildQuery($columnName, $value);

        return $this->buildResult($result);
    }

    /**
     * Fail safe for property fetching.
     *
     * @param $property
     * @return void|null
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return;
        }

        return null;
    }

    /**
     * Delete row.
     *
     * @throws Exception
     */
    public function delete(): void
    {
        if (!$this->id) {
            return;
        }

        $this->deleteWithCondition('id', $this->id);
    }

    /**
     * delete individual post from the database
     * @param $column
     * @param $value
     * @return void
     * @throws Exception
     */
    public function deleteWithCondition($column, $value): void
    {
        $this->db->query("DElETE FROM {$this->tableName} WHERE $column = '{$value}'");

        if ($this->db->error) {
            throw new Exception($this->db->error);
        }
    }
}