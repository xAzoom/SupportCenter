<?php

namespace AppBundle\Service;

use AppBundle\Utils\Slugger;
use DbBundle\Services\ColumnTypes;
use DbBundle\Services\IDbManager;

class CreateTicketsTable
{
    /**
     * @var IDbManager
     */
    private $dbManager;
    /**
     * @var Slugger
     */
    private $slugger;

    public function __construct(IDbManager $dbManager, Slugger $slugger)
    {
        $this->dbManager = $dbManager;
        $this->slugger = $slugger;
    }

    public function create(array $data)
    {
        $name = $this->slugger->slugify($data['name'], "_") . '_tickets';
        $columns = $this->inputsToColumns($data['inputs']);

        // TODO Exception
        $this->dbManager->createTable($name, $columns);
    }

    private function inputsToColumns(array $inputs)
    {
        $columns = [];
        foreach ($inputs as $input) {
            $columns[] = $this->inputToColumn($input);
        }

        return $columns;
    }

    private function inputToColumn(array $input)
    {
        return [
            $this->slugger->slugify($input['name'], "_"),
            $this->inputTypeToColumnType($input['type']),
            $this->inputOptionsToColumnOptions($input['type'], $input['options'])
        ];
    }

    private function inputTypeToColumnType($type)
    {
        switch ($type) {
            case InputTypeConfig::TEXT:
                return ColumnTypes::STRING;
            case InputTypeConfig::INTEGER:
                return ColumnTypes::INTEGER;
            case InputTypeConfig::FLOAT:
                return ColumnTypes::FLOAT;
            case InputTypeConfig::SELECT:
                return ColumnTypes::STRING;
        }

        throw new \Exception(printf('Undefined column type for %s', $type));
    }

    private function inputOptionsToColumnOptions($type, array $options)
    {
        switch ($type) {
            case InputTypeConfig::TEXT:
                {
                    if (array_key_exists('maxLength', $options)) {
                        return ['length' => $options['maxLength']];
                    }
                }
        }

        return [];
    }
}