<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Seven\Api\Library\ParamsInterface;

class RcsSuggestionParams implements ParamsInterface
{
    protected ?string $phoneNumber = null;
    protected ?RcsLocationParams $location = null;
    protected ?RcsCalendarEventParams $calendarEvent = null;
    protected ?string $url = null;
    protected ?RcsWebviewMode $webviewMode = null;

    public function __construct(
        protected RcsSuggestionType $type,
        protected string $text,
        protected string $postbackData,
    ) {
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['type'] = $this->type->value;

        if ($this->location) {
            $arr['location'] = $this->location->toArray();
        }

        if ($this->calendarEvent) {
            $arr['calendarEvent'] = $this->calendarEvent->toArray();
        }

        if ($this->webviewMode) {
            $arr['webviewMode'] = $this->webviewMode->value;
        }

        return $arr;
    }

    public function getType(): RcsSuggestionType
    {
        return $this->type;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getPostbackData(): string
    {
        return $this->postbackData;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getLocation(): ?RcsLocationParams
    {
        return $this->location;
    }

    public function setLocation(?RcsLocationParams $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function getCalendarEvent(): ?RcsCalendarEventParams
    {
        return $this->calendarEvent;
    }

    public function setCalendarEvent(?RcsCalendarEventParams $calendarEvent): self
    {
        $this->calendarEvent = $calendarEvent;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getWebviewMode(): ?RcsWebviewMode
    {
        return $this->webviewMode;
    }

    public function setWebviewMode(?RcsWebviewMode $webviewMode): self
    {
        $this->webviewMode = $webviewMode;
        return $this;
    }
}
