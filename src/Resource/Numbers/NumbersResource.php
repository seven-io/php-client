<?php declare(strict_types=1);

namespace Seven\Api\Resource\Numbers;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;
use Seven\Api\Response\Numbers\ActiveNumbers;
use Seven\Api\Response\Numbers\AvailableNumbers;
use Seven\Api\Response\Numbers\NumberDeletion;
use Seven\Api\Response\Numbers\NumberOrder;
use Seven\Api\Response\Numbers\PhoneNumber;

class NumbersResource extends Resource {
    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function delete(string $number, bool $deleteImmediately = false): NumberDeletion {
        $path = 'numbers/active/' . $number;
        if ($deleteImmediately) $path .= '?delete_immediately=true';

        return new NumberDeletion($this->client->delete($path));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function order(OrderParams $params): NumberOrder {
        return new NumberOrder($this->client->post('numbers/order', $params->toArray()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function update(UpdateParams $params): PhoneNumber {
        return new PhoneNumber($this->client->patch('numbers/active/' . $params->getNumber(), $params->toArray()));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws RandomException
     * @throws UnexpectedApiResponseException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function listActive(): ActiveNumbers {
        return new ActiveNumbers($this->client->get('numbers/active'));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     */
    public function get(string $number): PhoneNumber {
        return new PhoneNumber($this->client->get('numbers/active/' . $number));
    }

    /**
     * @throws ForbiddenIpException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     * @throws RandomException
     * @throws MissingAccessRightsException
     * @throws InvalidApiKeyException
     */
    public function listAvailable(ListAvailableParams $params = new ListAvailableParams): AvailableNumbers {
        return new AvailableNumbers($this->client->get('numbers/available', $params->toArray()));
    }
}
