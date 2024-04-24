<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\SmsParams;
use Seven\Api\Response\Sms\Sms;
use Seven\Api\Response\Sms\SmsDelete;
use Seven\Api\Validator\SmsValidator;

class SmsResource extends Resource
{
    public function delete(int ...$ids): SmsDelete
    {
        $res = $this->client->delete('sms', compact('ids'));
        return new SmsDelete($res);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidOptionalArgumentException
     */
    public function dispatch(SmsParams $params): Sms
    {
        $this->validate($params);

        $res = $this->client->post('sms', $params->toArray());

        return new Sms($res);
    }

    /**
     * @param SmsParams $params
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate($params): void
    {
        (new SmsValidator($params))->validate();
    }
}
