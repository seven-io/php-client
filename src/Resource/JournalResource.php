<?php declare(strict_types=1);

namespace Seven\Api\Resource;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\JournalParams;
use Seven\Api\Response\Journal\JournalBase;
use Seven\Api\Response\Journal\JournalInbound;
use Seven\Api\Response\Journal\JournalOutbound;
use Seven\Api\Response\Journal\JournalReply;
use Seven\Api\Response\Journal\JournalVoice;
use Seven\Api\Validator\JournalValidator;

class JournalResource extends Resource
{

    /**
     * @return JournalInbound[]
     * @throws InvalidOptionalArgumentException
     */
    public function inbound(JournalParams $params = new JournalParams): array
    {
        return $this->fetch('inbound', JournalInbound::class, $params);
    }

    /**
     * @return JournalBase[]
     * @throws InvalidOptionalArgumentException
     */
    protected function fetch(string $type, string $class, JournalParams $params): array
    {
        $this->validate($params);

        $array = $this->client->get('journal/' . $type, $params->toArray());
        return array_map(static function ($value) use ($class) {
            return new $class($value);
        }, $array);
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function validate($params): void
    {
        (new JournalValidator($params))->validate();
    }

    /**
     * @return JournalOutbound[]
     * @throws InvalidOptionalArgumentException
     */
    public function outbound(JournalParams $params = new JournalParams): array
    {
        return $this->fetch('outbound', JournalOutbound::class, $params);
    }

    /**
     * @return JournalReply[]
     * @throws InvalidOptionalArgumentException
     */
    public function replies(JournalParams $params = new JournalParams): array
    {
        return $this->fetch('replies', JournalReply::class, $params);
    }

    /**
     * @return JournalVoice[]
     * @throws InvalidOptionalArgumentException
     */
    public function voice(JournalParams $params = new JournalParams): array
    {
        return $this->fetch('voice', JournalVoice::class, $params);
    }
}
