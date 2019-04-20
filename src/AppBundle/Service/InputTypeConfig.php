<?php

namespace AppBundle\Service;

class InputTypeConfig
{
    const TEXT = 'text';
    const NUMBER = 'number';
    const SELECT = 'select';

    const TEXT_TYPE = 'text';
    const NUMBER_TYPE = 'number';
    const REGEXP_TYPE = 'regexp';
    const VALUES_TYPE = 'values';

    public function getInputConfig()
    {
        $forms = [
            self::TEXT => [
                'placeholder' => self::TEXT_TYPE,
                'minLenght' => self::NUMBER_TYPE,
                'maxLenght' => self::NUMBER_TYPE,
                'regex' => self::REGEXP_TYPE,
            ],

            self::NUMBER => [
                'minValue' => self::NUMBER_TYPE,
                'maxValue' => self::NUMBER_TYPE,
                'step' => self::NUMBER_TYPE,
            ],

            self::SELECT => [
                'values' => self::VALUES_TYPE,
            ],
        ];

        return $forms;
    }
}