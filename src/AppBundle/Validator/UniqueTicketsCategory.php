<?php

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueTicketsCategory extends Constraint
{
    public $message = "This category name already exists.";
}