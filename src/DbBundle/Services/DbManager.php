<?php

namespace DbBundle\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;

class DbManager implements IDbManager
{
    /**
     * @var Connection
     */
    private $dbConnection;

    public function __construct(Connection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    private function select($table, array $columns, array $by)
    {
        $qB = $this->dbConnection->createQueryBuilder();
        $qB->select($columns)->from($table);

        foreach ($by as $key => $value) {
            $qB->andWhere($key . ' = :' . $key);
            $qB->setParameter($key, $value);
        }

        return $qB->execute();
    }

    public function findOneBy($table, array $columns, array $by)
    {
        return $this->select($table, $columns, $by)->fetch();
    }

    public function findBy($table, array $columns, array $by)
    {
        return $this->select($table, $columns, $by)->fetchAll();
    }

    public function insert($table, array $values)
    {
        $qB = $this->dbConnection->createQueryBuilder();
        $qB->insert($table);

        $columns = [];
        $i = 0;
        foreach ($values as $column => $value) {
            $columns[$column] = '?';
            $qB->setParameter($i++, $value);
        }
        $qB->values($columns);

        $qB->execute();
    }

    public function createTable($name, array $columns, array $primary_keys = [], array $unique_keys = [])
    {
        if (!$this->areValidDataToCreateTable($name, $columns, $primary_keys, $unique_keys)) {
            throw new \Exception('Invalid data to createTable');
        }

        if ($this->dbConnection->getSchemaManager()->tablesExist([$name])) {
            throw new \Exception(sprintf('Table with name %s already exist', $name));
        }

        $schema = new Schema();
        $table = $schema->createTable($name);

        foreach ($columns as $column) {
            $table->addColumn($column[0], $column[1], isset($column[2]) ? $column[2] : []);
        }


        if(!empty($primary_keys)) {
            $table->setPrimaryKey($primary_keys);
        }

        if(!empty($unique_keys)) {
            $table->addUniqueIndex($unique_keys);
        }

        $this->dbConnection->getSchemaManager()->createTable($table);
    }

    private function areValidDataToCreateTable($name, array $columns, array $primary_keys, array $unique_keys)
    {
        if (!is_string($name)) {
            return false;
        }

        if (!is_array($columns) || empty($columns)) {
            return false;
        }

        foreach ($columns as $column) {
            if (\count($column) < 2) {
                return false;
            }

            if (!ColumnTypes::isValidColumnType($column[1])) {
                return false;
            }

            if (isset($column[2]) && !is_array($column[2])) {
                return false;
            }
        }

        if (!is_array($primary_keys)) {
            return false;
        }

        if (!is_array($unique_keys)) {
            return false;
        }

        return true;
    }
}