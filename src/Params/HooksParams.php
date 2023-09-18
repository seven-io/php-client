<?php declare(strict_types=1);

namespace Seven\Api\Params;

class HooksParams implements ParamsInterface {
    protected string $action;
    protected ?string $eventFilter = null;
    protected ?string $eventType = null;
    protected ?int $id = null;
    protected ?string $requestMethod = null;
    protected ?string $targetUrl = null;

    public function __construct(string $action) {
        $this->action = $action;
    }

    public function getAction(): string {
        return $this->action;
    }

    public function setAction(string $action): self {
        $this->action = $action;
        return $this;
    }

    public function getTargetUrl(): ?string {
        return $this->targetUrl;
    }

    public function setTargetUrl(?string $targetUrl): self {
        $this->targetUrl = $targetUrl;
        return $this;
    }

    public function getEventType(): ?string {
        return $this->eventType;
    }

    public function setEventType(?string $eventType): self {
        $this->eventType = $eventType;
        return $this;
    }

    public function getEventFilter(): ?string {
        return $this->eventFilter;
    }

    public function setEventFilter(?string $eventFilter): self {
        $this->eventFilter = $eventFilter;
        return $this;
    }

    public function getRequestMethod(): ?string {
        return $this->requestMethod;
    }

    public function setRequestMethod(?string $requestMethod): self {
        $this->requestMethod = $requestMethod;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function toArray(): array {
        $arr = get_object_vars($this);

        if (isset($arr['eventFilter'])) {
            $arr['event_filter'] = $arr['eventFilter'];
            unset($arr['eventFilter']);
        }

        if (isset($arr['eventType'])) {
            $arr['event_type'] = $arr['eventType'];
            unset($arr['eventType']);
        }

        if (isset($arr['requestMethod'])) {
            $arr['request_method'] = $arr['requestMethod'];
            unset($arr['requestMethod']);
        }

        if (isset($arr['targetUrl'])) {
            $arr['target_url'] = $arr['targetUrl'];
            unset($arr['targetUrl']);
        }

        return $arr;
    }
}
