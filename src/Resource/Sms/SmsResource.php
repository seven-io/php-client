<?php declare(strict_types=1);

namespace Seven\Api\Resource\Sms;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Params\SmsParams;
use Seven\Api\Resource\Resource;
use Seven\Api\Response\Sms\Sms;
use Seven\Api\Response\Sms\SmsDelete;
use Seven\Api\Validator\SmsValidator;

class SmsResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(int ...$ids): SmsDelete {
        $res = $this->client->delete('sms', compact('ids'));
        return new SmsDelete($res);
    }

    /**
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function dispatch(SmsParams $params): Sms {
        $this->validate($params);

        $res = $this->client->post('sms', $params->toArray());

        return new Sms($res);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(SmsParams $params): void {
        (new SmsValidator($params))->validate();
    }
}
