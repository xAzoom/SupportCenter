<?php

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueLogin extends Constraint
{
    public $message = "This email is not unique.";
}