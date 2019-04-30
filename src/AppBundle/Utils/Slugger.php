<?php

namespace AppBundle\Utils;

class Slugger
{
    public function slugify($value, $separator = "-")
    {
        if (!is_string($value)) {
            throw new \Exception('Slugify different type than string');
        }

        $value = trim($value);
        $value = strtolower($value);
        $value = str_replace(' ', $separator, $value);

        return $value;
    }
}