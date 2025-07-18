<?php declare(strict_types=1);

namespace Seven\Api\Resource\Hooks;

class Hook {
    protected string $created;
    protected bool $enabled;
    protected ?string $eventFilter;
    protected string $eventType;
    protected string $headers;
    protected int $id;
    protected string $requestMethod;
    protected string $targetUrl;

    public function __construct(object $data) {
        $this->created = $data->created;
        $this->enabled = $data->enabled;
        $this->eventFilter = $data->event_filter;
        $this->eventType = $data->event_type;
        $this->headers = $data->headers;
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

    public function getHeaders(): string {
        return $this->headers;
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

    public function getEventFilter(): ?string {
        return $this->eventFilter;
    }

    public function isEnabled(): bool {
        return $this->enabled;
    }
}
