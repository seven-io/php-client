<?php

namespace Seven\Api\Resource;

use Seven\Api\Constant\JournalConstants;
use Seven\Api\Constant\JournalType;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\JournalParams;
use Seven\Api\Response\Journal\JournalBase;
use Seven\Api\Response\Journal\JournalInbound;
use Seven\Api\Response\Journal\JournalOutbound;
use Seven\Api\Response\Journal\JournalReply;
use Seven\Api\Response\Journal\JournalVoice;
use Seven\Api\Validator\JournalValidator;

class JournalResource extends Resource {

    /**
     * @return JournalInbound[]
     * @throws InvalidOptionalArgumentException
     */
    public function inbound(JournalParams $params = null): array {
        return $this->fetch(JournalType::INBOUND, $params);
    }

    /**
     * @return JournalBase[]
     * @throws InvalidOptionalArgumentException
     */
    protected function fetch(string $type, JournalParams $params = null): array {
        if (!$params) $params = new JournalParams;

        $this->validate($params);

        switch ($type) {
            case JournalType::VOICE:
                $class = JournalVoice::class;
                break;
            case JournalType::OUTBOUND:
                $class = JournalOutbound::class;
                break;
            case JournalType::REPLIES:
                $class = JournalReply::class;
                break;
            default:
                $class = JournalInbound::class;
        }

        $array = $this->client->get(
            JournalConstants::ENDPOINT,
            array_merge($params->toArray(), compact('type'))
        );
        return array_map(static function ($value) use ($class) {
            return new $class($value);
        }, $array);
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void {
        (new JournalValidator($params))->validate();
    }

    /**
     * @return JournalOutbound[]
     * @throws InvalidOptionalArgumentException
     */
    public function outbound(JournalParams $params = null): array {
        return $this->fetch(JournalType::OUTBOUND, $params);
    }

    /**
     * @return JournalReply[]
     * @throws InvalidOptionalArgumentException
     */
    public function replies(JournalParams $params = null): array {
        return $this->fetch(JournalType::REPLIES, $params);
    }

    /**
     * @return JournalVoice[]
     * @throws InvalidOptionalArgumentException
     */
    public function voice(JournalParams $params = null): array {
        return $this->fetch(JournalType::VOICE, $params);
    }
}
