<?php

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class SmsValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate()
    {
        $this->debug();
        $this->delay();
        $this->details();
        $this->flash();
        $this->from();
        $this->json();
        $this->label();
        $this->no_reload();
        $this->performance_tracking();
        $this->return_msg_id();
        $this->text();
        $this->to();
        $this->type();
        $this->udh();
        $this->unicode();
        $this->utf8();
        $this->ttl();
    }

    function debug()
    {
        $debug = isset($this->parameters["debug"]) ? $this->parameters["debug"] : null;

        if (null !== $debug) {
            if (!$this->isValidBool($debug)) {
                throw new InvalidOptionalArgumentException("debug can be either 1 or 0.");
            }
        }
    }

    function delay()
    {
        $delay = isset($this->parameters["delay"]) ? $this->parameters["delay"] : null;

        if (null !== $delay) {
            $dateFormat = "yyyy-mm-dd hh:ii";

            $parts = explode("-", $delay);
            $year = $parts[0];
            $month = $parts[1];
            $day = $parts[2];
            $hour = $parts[3];
            $min = $parts[4];

            if (false === stripos($delay, "-")) {
                if (!$this->isValidUnixTimestamp($delay)) {
                    throw new InvalidOptionalArgumentException("Delay must be a valid UNIX timestamp or in the format of $dateFormat.");
                }
            } else {
                if (!preg_match("/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/", $hour . ":" . $min)) {
                    throw new InvalidOptionalArgumentException("date seems to have an invalid format.");
                }

                if (!checkdate($month, $day, $year)) {
                    throw new InvalidOptionalArgumentException("Delay must be a valid UNIX timestamp or in the format of $dateFormat.");
                }
            }
        }
    }

    function details()
    {
        $details = isset($this->parameters["details"]) ? $this->parameters["details"] : null;

        if (null !== $details && !$this->isValidBool($details)) {
            throw new InvalidOptionalArgumentException("details can be either 1 or 0.");
        }
    }

    function label()
    {
        //TODO: max length?! there must be one.

        $label = isset($this->parameters["label"]) ? $this->parameters["label"] : null;

        if (null !== $label) {
            $pattern = "/[0-9a-z\-@_.]/i";

            if (strlen($label) !== preg_match_all($pattern, $label)) {
                throw new InvalidOptionalArgumentException("label must match the regex pattern $pattern.");
            }
        }
    }

    function flash()
    {
        $flash = isset($this->parameters["flash"]) ? $this->parameters["flash"] : null;

        if (null !== $flash) {
            if (!$this->isValidBool($flash)) {
                throw new InvalidOptionalArgumentException("flash can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $flash) {
                throw new InvalidOptionalArgumentException("Only messages of type direct can be sent as flash messages.");
            }

        }
    }

    function from()
    {
        $from = isset($this->parameters["from"]) ? $this->parameters["from"] : null;

        if (null !== $from) {
            $length = strlen($from);

            $alphaNumericMax = 11;
            $numericMax = 16;

            $isNumeric = is_numeric($from);

            if ($length > $numericMax) {
                throw new InvalidOptionalArgumentException("from is too long as it exceeds $numericMax characters.");
            }

            if ($length > $alphaNumericMax) {
                if (!$isNumeric) {
                    throw new InvalidOptionalArgumentException("from longer than $alphaNumericMax characters must be numeric.");
                }
            } elseif (!$isNumeric || !ctype_alnum($from)) {
                throw new InvalidOptionalArgumentException("from does not seem to be a valid sender.");
            }
        }
    }

    function json()
    {
        $json = isset($this->parameters["json"]) ? $this->parameters["json"] : null;

        if (null !== $json) {
            if (!$this->isValidBool($json)) {
                throw new InvalidOptionalArgumentException("json can be either 1 or 0.");
            }
        }
    }

    function no_reload()
    {
        $noReload = isset($this->parameters["no_reload"]) ? $this->parameters["no_reload"] : null;

        if (null !== $noReload) {
            if (!$this->isValidBool($noReload)) {
                throw new InvalidOptionalArgumentException("no_reload can be either 1 or 0.");
            }
        }
    }

    function performance_tracking()
    {
        $performanceTracking = isset($this->parameters["performance_tracking"]) ? $this->parameters["performance_tracking"] : null;

        if (null !== $performanceTracking) {
            if (!$this->isValidBool($performanceTracking)) {
                throw new InvalidOptionalArgumentException("performance_tracking can be either 1 or 0.");
            }
        }
    }

    function return_msg_id()
    {
        $returnMsgId = isset($this->parameters["return_msg_id"]) ? $this->parameters["return_msg_id"] : null;

        if (null !== $returnMsgId) {
            if (!$this->isValidBool($returnMsgId)) {
                throw new InvalidOptionalArgumentException("return_msg_id can be either 1 or 0.");
            }
        }
    }

    function text()
    {
        $text = isset($this->parameters["text"]) ? $this->parameters["text"] : null;

        if (null === $text) {
            throw new InvalidRequiredArgumentException("You cannot send an empty message.");
        }

        $length = strlen($text);

        if (!$length) {
            throw new InvalidRequiredArgumentException("You cannot send an empty message.");
        }

        $maxTextLength = 1520;

        if ($maxTextLength < $length) {
            throw new InvalidRequiredArgumentException("The text can not be longer than $maxTextLength characters.");
        }
    }

    function to()
    {
        $to = isset($this->parameters["to"]) ? $this->parameters["to"] : null;

        if (null === $to) {
            throw new InvalidRequiredArgumentException("You cannot send a message without specifying a recipient.");
        }
    }

    function ttl()
    {
        $ttl = isset($this->parameters["ttl"]) ? $this->parameters["ttl"] : null;

        if (null !== $ttl) {
            $min = 300000;
            $max = 86400000;

            if ($ttl < $min) {
                throw new InvalidOptionalArgumentException("ttl must be at least $min.");
            }

            if ($ttl > $max) {
                throw new InvalidOptionalArgumentException("ttl may not exceed $max.");
            }
        }
    }

    function type()
    {
        $this->throwOnOptionalBadType();
    }

    function udh()
    {
        $udh = isset($this->parameters["udh"]) ? $this->parameters["udh"] : null;

        if (null !== $udh) {
            if (!$this->isValidBool($udh)) {
                throw new InvalidOptionalArgumentException("udh can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $udh) {
                throw new InvalidOptionalArgumentException("Only messages of type direct can be sent as udh messages.");
            }
        }
    }

    function unicode()
    {
        $unicode = isset($this->parameters["unicode"]) ? $this->parameters["unicode"] : null;

        if (null !== $unicode) {
            if (!$this->isValidBool($unicode)) {
                throw new InvalidOptionalArgumentException("unicode can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $unicode) {
                throw new InvalidOptionalArgumentException("Only messages of type direct can be unicode encoded.");
            }
        }
    }

    function utf8()
    {
        $utf8 = isset($this->parameters["utf8"]) ? $this->parameters["utf8"] : null;

        if (null !== $utf8) {
            if (!$this->isValidBool($utf8)) {
                throw new InvalidOptionalArgumentException("utf8 can be either 1 or 0.");
            }
        }
    }
}