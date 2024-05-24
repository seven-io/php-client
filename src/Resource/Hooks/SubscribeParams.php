<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

use Seven\Api\Library\ParamsInterface;

class SubscribeParams implements ParamsInterface {
    protected ?string $eventFilter = null;
    protected HooksRequestMethod $requestMethod = HooksRequestMethod::POST;

    public function __construct(protected string $targetUrl, protected HooksEventType $eventType) {
    }

    public function toArray(): array {
        $arr = get_object_vars($this);

        $arr['event_filter'] = $this->eventFilter;
        $arr['event_type'] = $this->eventType->value;
        $arr['request_method'] = $this->requestMethod->name;
        $arr['target_url'] = $this->targetUrl;

        unset($arr['eventFilter'], $arr['eventType'], $arr['requestMethod'], $arr['targetUrl']);

        return $arr;
    }

    public function getEventFilter(): ?string {
        return $this->eventFilter;
    }

    public function setEventFilter(?string $eventFilter): self {
        $this->eventFilter = $eventFilter;
        return $this;
    }

    public function getTargetUrl(): string {
        return $this->targetUrl;
    }

    public function getEventType(): HooksEventType {
        return $this->eventType;
    }

    public function getRequestMethod(): HooksRequestMethod {
        return $this->requestMethod;
    }

    public function setRequestMethod(HooksRequestMethod $requestMethod): self {
        $this->requestMethod = $requestMethod;
        return $this;
    }
}
