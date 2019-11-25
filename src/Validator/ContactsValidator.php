<?php

namespace Sms77\Api\Validator;

use Exception;

class ContactsValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->action();
        $this->json();
    }

    function action()
    {
        $action = isset($this->parameters["action"]) ? $this->parameters["action"] : null;

        $actions = ["read", "write", "del"];

        if (!in_array($action, $actions)) {
            throw new Exception("Unknown action $action.");
        }
    }

    function json()
    {
        $json = isset($this->parameters["json"]) ? $this->parameters["json"] : null;

        if (null !== $json) {
            if (!$this->isValidBool($json)) {
                throw new Exception("The parameter json can be either 1 or 0.");
            }
        }
    }
}