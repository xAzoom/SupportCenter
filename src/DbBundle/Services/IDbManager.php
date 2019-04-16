<?php

namespace DbBundle\Services;

interface IDbManager
{
    public function findOneBy($table, array $columns, array $by);
    public function findBy($table, array $columns, array $by);
    public function insert($table, array $values);
}