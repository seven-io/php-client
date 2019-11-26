<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

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

        if (null !== $from && !strlen($from)) {
            throw new InvalidOptionalArgumentException("from may not be empty if set.");
        }
    }

    function text()
    {
        $text = isset($this->parameters["text"]) ? $this->parameters["text"] : null;

        if (!isset($text) || !strlen($text)) {
            throw new InvalidRequiredArgumentException("text is missing.");
        }
    }

    function to()
    {
        $to = isset($this->parameters["to"]) ? $this->parameters["to"] : null;

        if (!isset($to) || !strlen($to)) {
            throw new InvalidRequiredArgumentException("to is missing.");
        }
    }

    function xml()
    {
        $xml = isset($this->parameters["xml"]) ? $this->parameters["xml"] : null;

        if (!$this->isValidBool($xml)) {
            throw new InvalidOptionalArgumentException("xml can be either 1 or 0.");
        }
    }
}