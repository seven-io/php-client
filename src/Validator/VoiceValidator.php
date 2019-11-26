<?php

namespace Sms77\Api\Validator;

use Exception;

class VoiceValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->from();
        $this->text();
        $this->to();
        $this->xml();
    }

    function from()
    {
        $from = isset($this->parameters["from"]) ? $this->parameters["from"] : null;

        if (null !== $from) {
            if (!strlen($from)) {
                throw new Exception("The parameter from may not be empty if set.");
            }
        }
    }

    function text()
    {
        $text = isset($this->parameters["text"]) ? $this->parameters["text"] : null;

        if (!isset($text) || !strlen($text)) {
            throw new Exception("The required parameter text is missing.");
        }
    }

    function to()
    {
        $to = isset($this->parameters["to"]) ? $this->parameters["to"] : null;

        if (!isset($to) || !strlen($to)) {
            throw new Exception("The required parameter to is missing.");
        }
    }

    function xml()
    {
        $xml = isset($this->parameters["xml"]) ? $this->parameters["xml"] : null;

        if (!$this->isValidBool($xml)) {
            throw new Exception("The parameter xml can be either 1 or 0.");
        }
    }
}