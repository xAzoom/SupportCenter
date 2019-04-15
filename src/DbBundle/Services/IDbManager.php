<?php
/**
 * Created by PhpStorm.
 * User: azoom
 * Date: 15.04.19
 * Time: 21:34
 */

namespace DbBundle\Services;


interface IDbManager
{
    public function findOneBy($table, array $columns, array $by);
    public function findBy($table, array $columns, array $by);
}