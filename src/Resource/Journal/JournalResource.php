<?php declare(strict_types=1);

namespace Seven\Api\Resource\Journal;

use Random\RandomException;
use Seven\Api\Exception\ForbiddenIpException;
use Seven\Api\Exception\InvalidApiKeyException;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\MissingAccessRightsException;
use Seven\Api\Exception\SigningHashVerificationException;
use Seven\Api\Exception\UnexpectedApiResponseException;
use Seven\Api\Resource\Resource;

class JournalResource extends Resource {

    /**
     * @return JournalInbound[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function inbound(JournalParams $params = new JournalParams): array {
        return $this->fetch('inbound', JournalInbound::class, $params);
    }

    /**
     * @return JournalBase[]
     * @throws InvalidOptionalArgumentException
     * @throws RandomException
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws MissingAccessRightsException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    protected function fetch(string $type, string $class, JournalParams $params): array {
        $this->validate($params);

        $array = $this->client->get('journal/' . $type, $params->toArray());
        return array_map(static function ($value) use ($class) {
            return new $class($value);
        }, $array);
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(JournalParams $params): void {
        (new JournalValidator($params))->validate();
    }

    /**
     * @return JournalOutbound[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function outbound(JournalParams $params = new JournalParams): array {
        return $this->fetch('outbound', JournalOutbound::class, $params);
    }


    /**
     * @return JournalVoice[]
     * @throws ForbiddenIpException
     * @throws InvalidApiKeyException
     * @throws InvalidOptionalArgumentException
     * @throws MissingAccessRightsException
     * @throws RandomException
     * @throws SigningHashVerificationException
     * @throws UnexpectedApiResponseException
     */
    public function voice(JournalParams $params = new JournalParams): array {
        return $this->fetch('voice', JournalVoice::class, $params);
    }
}
