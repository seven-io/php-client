<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class VoiceValidator extends BaseValidator implements ValidatorInterface
{
    public function validate()
    {
        $this->from();
        $this->text();
        $this->to();
        $this->xml();
    }

    public function from()
    {
        $from = isset($this->parameters['from']) ? $this->parameters['from'] : null;

        if (null !== $from && '' === $from) {
            throw new InvalidOptionalArgumentException('from may not be empty if set.');
        }
    }

    public function text()
    {
        $text = isset($this->parameters['text']) ? $this->parameters['text'] : null;

        if (!isset($text) || '' === $text) {
            throw new InvalidRequiredArgumentException('text is missing.');
        }
    }

    public function to()
    {
        $to = isset($this->parameters['to']) ? $this->parameters['to'] : null;

        if (!isset($to) || '' === $to) {
            throw new InvalidRequiredArgumentException('to is missing.');
        }
    }

    public function xml()
    {
        $xml = isset($this->parameters['xml']) ? $this->parameters['xml'] : null;

        if (!$this->isValidBool($xml)) {
            throw new InvalidOptionalArgumentException('xml can be either 1 or 0.');
        }
    }
}