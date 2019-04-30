<?php

namespace AppBundle\Service;

class InputValidator
{
    /**
     * @var InputTypeConfig
     */
    private $inputTypeConfig;

    public function __construct(InputTypeConfig $inputTypeConfig)
    {
        $this->inputTypeConfig = $inputTypeConfig;
    }

    /**
     * Example of valid array inputs:
     * [
     *      [
     *          "name" => "First name",
     *          "type" => "text",
     *          "options" => [
     *              "placeholder" => "First name"
     *          ]
     *      ]
     * ]
     */
    public function areValidInputs(array $inputs)
    {
        foreach ($inputs as $input) {
            if (!is_array($input) || empty($input)) {
                return false;
            }

            if (!$this->isValidInput($input)) {
                return false;
            }
        }

        return true;
    }

    private function isValidInput(array $form)
    {
        $keys = ['name', 'type', 'options'];
        foreach ($keys as $key) {
            if (!array_key_exists($key, $form)) {
                return false;
            }
        }

        if (!$this->isValidType($form['type'])) {
            return false;
        }

        if (!$this->areValidOptions($form['type'], $form['options'])) {
            return false;
        }

        return true;
    }

    private function isValidType($type)
    {
        return array_key_exists($type, $this->inputTypeConfig->getInputConfig());
    }

    private function areValidOptions($type, array $options)
    {
        if (!is_array($options)) {
            return false;
        }

        if (empty($values)) {
            return true;
        }

        $formsConfig = $this->inputTypeConfig->getInputConfig();

        foreach ($options as $option => $value) {
            if (!array_key_exists($option, $formsConfig[$type])) {
                return false;
            }

            if (!$this->isValidTypeValueOption($formsConfig[$type][$option], $value)) {
                return false;
            }
        }

        return true;
    }

    private function isValidTypeValueOption($typeOption, $value)
    {
        switch ($typeOption) {
            case InputTypeConfig::TEXT_TYPE:
                return is_string($value);
            case InputTypeConfig::NUMBER_TYPE:
                return is_int($value) || is_float($value);
            case InputTypeConfig::VALUES_TYPE:
                return $this->isSelectValues($value);
        }

        return true;
    }

    private function isSelectValues(array $values)
    {
        if (!is_array($values) || empty($values)) {
            return false;
        }

        foreach ($values as $value) {
            if (!is_string($value)) {
                return false;
            }
        }

        return true;
    }
}