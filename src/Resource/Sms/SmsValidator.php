<?php declare(strict_types=1);

namespace Seven\Api\Resource\Sms;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;

class SmsValidator
{
    use SmsRules;

    public function __construct(protected SmsParams $params)
    {
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void
    {
        $this->delay();
        $this->foreign_id();
        $this->from();
        $this->label();
        $this->text();
        $this->to();
        $this->ttl();
    }
}
