<?php declare(strict_types=1);

namespace Seven\Api\Response\Hooks;

class Hook {
    protected string $created;
    protected string $eventType;
    protected int $id;
    protected string $requestMethod;
    protected string $targetUrl;

    public function __construct(object $data) {
        $this->created = $data->created;
        $this->eventType = $data->event_type;
        $this->id = (int)$data->id;
        $this->requestMethod = $data->request_method;
        $this->targetUrl = $data->target_url;
    }

    public function getCreated(): string {
        return $this->created;
    }

    public function getEventType(): string {
        return $this->eventType;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getRequestMethod(): string {
        return $this->requestMethod;
    }

    public function getTargetUrl(): string {
        return $this->targetUrl;
    }
}
