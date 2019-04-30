<?php

namespace AppBundle\Validator;

use DbBundle\Services\IDbManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueTicketsCategoryValidator extends ConstraintValidator
{
    /**
     * @var IDbManager
     */
    private $dbManager;

    public function __construct(IDbManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!empty($this->dbManager->findOneBy('categories', ['id'], ['name' => $value]))) {
            $this->context->addViolation($constraint->message);
        }
    }
}