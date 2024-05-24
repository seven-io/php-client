<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

readonly class RcsEventParams implements ParamsInterface
{
    public function __construct(
        public string   $to,
        public RcsEvent $event,
        public string   $msgId = ''
    )
    {
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['msg_id'] = $this->msgId;
        unset($arr['msgId']);

        $arr['event'] = $this->event->name;

        return $arr;
    }
}
