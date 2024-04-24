<?php declare(strict_types=1);

namespace Seven\Api\Params\Hooks;

use Seven\Api\Constant\HooksEventType;
use Seven\Api\Constant\HooksRequestMethod;
use Seven\Api\Params\ParamsInterface;

class SubscribeParams implements ParamsInterface
{
    protected ?string $eventFilter = null;
    protected HooksRequestMethod $requestMethod = HooksRequestMethod::POST;

    public function __construct(protected string $targetUrl, protected HooksEventType $eventType)
    {
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['event_filter'] = $this->eventFilter;
        $arr['event_type'] = $this->eventType;
        $arr['request_method'] = $this->requestMethod;
        $arr['target_url'] = $this->targetUrl;

        unset($arr['eventFilter'], $arr['eventType'], $arr['requestMethod'], $arr['targetUrl']);

        return $arr;
    }
}
