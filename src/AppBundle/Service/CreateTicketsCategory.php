<?php

namespace AppBundle\Service;

use AppBundle\Utils\Slugger;
use DbBundle\Services\IDbManager;

class CreateTicketsCategory
{
    /**
     * @var IDbManager
     */
    private $dbManager;
    /**
     * @var Slugger
     */
    private $slugger;
    /**
     * @var CreateTicketsTable
     */
    private $ticketsTable;

    public function __construct(IDbManager $dbManager, Slugger $slugger, CreateTicketsTable $ticketsTable)
    {
        $this->dbManager = $dbManager;
        $this->slugger = $slugger;
        $this->ticketsTable = $ticketsTable;
    }

    public function create(array $data)
    {
        // TODO Exception
        $this->ticketsTable->create($data);

        $this->dbManager->insert('categories', [
            'name' => $data['name'],
            'form' => json_encode($data['inputs'])
        ]);
    }
}