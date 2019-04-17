<?php

namespace DbBundle\Services;

use Doctrine\DBAL\Connection;

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
            $qB->andWhere($key.' = :'.$key);
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
}