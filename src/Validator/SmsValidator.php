<?php
declare(strict_types=1);

namespace Sms77\Api\Validator;

use Exception;

class SmsValidator extends BaseValidator implements ValidatorInterface
{
    function __construct(array $parameters)
    {
        parent::__construct($parameters);
    }

    function validate(): void
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
        $this->type();
        $this->udh();
        $this->unicode();
        $this->utf8();
        $this->ttl();
    }

    private function isValidBool($data): bool
    {
        return 1 == $data || 0 == $data;
    }

    function debug(): void
    {
        $debug = $this->parameters["debug"] ?? null;

        if (null !== $debug) {
            if (!$this->isValidBool($debug)) {
                throw new Exception("The parameter debug can be either 1 or 0.");
            }
        }
    }

    function delay(): void
    {
        $delay = $this->parameters["delay"] ?? null;


        if (null !== $delay) {
            $dateFormat = "yyyy-mm-dd hh:ii";

            $parts = explode("-", $delay);
            $year = $parts[0];
            $month = $parts[1];
            $day = $parts[2];
            $hour = $parts[3];
            $min = $parts[4];

            if (false === stripos($delay, "-")) {
                if (!isValidUnixTimestamp($delay)) {
                    throw new Exception("Delay must be a valid UNIX timestamp or in the format of $dateFormat.");
                }

                /*https://stackoverflow.com/questions/2524680/check-whether-the-string-is-a-unix-timestamp*/
                function isValidUnixTimestamp($timestamp)
                {
                    return ((string)(int)$timestamp === $timestamp)
                        && ($timestamp <= PHP_INT_MAX)
                        && ($timestamp >= ~PHP_INT_MAX);
                }
            } else {
                if (!preg_match("/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/", $hour . ":" . $min)) {
                    throw new Exception("Invalid format for the date.");
                }

                if (!checkdate($month, $day, $year)) {
                    throw new Exception("Delay must be a valid UNIX timestamp or in the format of $dateFormat.");
                }
            }
        }
    }

    function details(): void
    {
        $details = $this->parameters["details"] ?? null;

        if (null !== $details) {
            if (!$this->isValidBool($details)) {
                throw new Exception("The parameter details can be either 1 or 0.");
            }
        }
    }

    function label(): void
    {
        $label = $this->parameters["label"] ?? null;

        //TODO: max length?! there must be one.

        if (null !== $label) {
            $pattern = "/[0-9a-z\-@_.]/i";

            if (strlen($label) !== preg_match_all($pattern, $label)) {
                throw new Exception("The label must match the regex pattern $pattern.");
            }
        }
    }

    function flash(): void
    {
        $flash = $this->parameters["flash"] ?? null;

        if (null !== $flash) {
            if (!$this->isValidBool($flash)) {
                throw new Exception("The parameter flash can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $flash) {
                throw new Exception("Only messages of type direct can be sent as flash messages.");
            }

        }
    }

    function from(): void
    {
        $from = $this->parameters["from"] ?? null;

        if (null !== $from) {
            $length = strlen($from);

            $alphaNumericMax = 11;
            $numericMax = 16;

            $isNumeric = is_numeric($from);

            if ($length > $numericMax) {
                throw new Exception("Sender name is too long as it exceeds $numericMax characters.");
            }

            if ($length > $alphaNumericMax) {
                if (!$isNumeric) {
                    throw new Exception("Sender names longer than $alphaNumericMax characters must be numeric.");
                }
            } elseif (!$isNumeric || !ctype_alnum($from)) {
                throw new Exception("Invalid sender.");
            }
        }
    }

    function json(): void
    {
        $json = $this->parameters["json"] ?? null;

        if (null !== $json) {
            if (!$this->isValidBool($json)) {
                throw new Exception("The parameter json can be either 1 or 0.");
            }
        }
    }

    function no_reload(): void
    {
        $noReload = $this->parameters["no_reload"] ?? null;

        if (null !== $noReload) {
            if (!$this->isValidBool($noReload)) {
                throw new Exception("The parameter no_reload can be either 1 or 0.");
            }
        }
    }

    function performance_tracking(): void
    {
        $performanceTracking = $this->parameters["performance_tracking"] ?? null;

        if (null !== $performanceTracking) {
            if (!$this->isValidBool($performanceTracking)) {
                throw new Exception("The parameter performance_tracking can be either 1 or 0.");
            }
        }
    }

    function return_msg_id(): void
    {
        $returnMsgId = $this->parameters["return_msg_id"] ?? null;

        if (null !== $returnMsgId) {
            if (!$this->isValidBool($returnMsgId)) {
                throw new Exception("The parameter return_msg_id can be either 1 or 0.");
            }
        }
    }

    function ttl(): void
    {
        $ttl = $this->parameters["ttl"] ?? null;

        if (null !== $ttl) {
            $ms = ["min" => 300000, "max" => 86400000];

            if ($ttl < $ms["min"]) {
                throw new Exception("The minimum TTL is " . $ms["min"] . " .");
            }

            if ($ttl > $ms["max"]) {
                throw new Exception("The maximum TTL is " . $ms["max"] . " .");
            }
        }
    }

    function text(): void
    {
        $text = $this->parameters["text"] ?? null;

        if (null === $text) {
            throw new Exception("You cannot send an empty message.");
        }

        $length = strlen($text);

        if (!$length) {
            throw new Exception("You cannot send an empty message.");
        }

        $maxTextLength = 1520;

        if ($maxTextLength < $length) {
            throw new Exception("The text can not be longer than $maxTextLength characters.");
        }
    }

    function type(): void
    {
        $type = $this->parameters["type"] ?? null;

        if (null !== $type) {
            $allowedTypes = ["economy", "direct"];

            if (!in_array($type, $allowedTypes)) {
                throw new Exception("Type must be one of the following: " . join(",", $allowedTypes) . " .");
            }
        }
    }

    function udh(): void
    {
        $udh = $this->parameters["udh"] ?? null;

        if (null !== $udh) {
            if (!$this->isValidBool($udh)) {
                throw new Exception("The parameter udh can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $udh) {
                throw new Exception("Only messages of type direct can be sent as udh messages.");
            }
        }
    }

    function unicode(): void
    {
        $unicode = $this->parameters["unicode"] ?? null;

        if (null !== $unicode) {
            if (!$this->isValidBool($unicode)) {
                throw new Exception("The parameter unicode can be either 1 or 0.");
            }

            if ("direct" != $this->parameters["type"] && $unicode) {
                throw new Exception("Only messages of type direct can be unicode encoded.");
            }
        }
    }

    function utf8(): void
    {
        $utf8 = $this->parameters["utf8"] ?? null;

        if (null !== $utf8) {
            if (!$this->isValidBool($utf8)) {
                throw new Exception("The parameter utf8 can be either 1 or 0.");
            }
        }
    }
}