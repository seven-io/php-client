<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\HooksAction;
use Seven\Api\Constant\HooksEventType;
use Seven\Api\Constant\HooksRequestMethod;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Library\Util;
use Seven\Api\Params\HooksParams;

class HooksValidator {
    protected HooksParams $params;

    public function __construct(HooksParams $params) {
        $this->params = $params;
    }

    /** @throws InvalidRequiredArgumentException */
    public function validate(): void {
        $this->action();

        switch ($this->params->getAction()) {
            case HooksAction::READ:
                $this->read();
                break;
            case HooksAction::SUBSCRIBE:
                $this->subscribe();
                break;
            case HooksAction::UNSUBSCRIBE:
                $this->unsubscribe();
                break;
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $action = $this->params->getAction();

        if (!in_array($action, HooksAction::values()))
            throw new InvalidRequiredArgumentException('Unknown action: ' . $action);
    }

    protected function read(): void {
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    protected function subscribe(): void {
        $this->eventFilter();
        $this->eventType();
        $this->requestMethod();
        $this->targetUrl();
    }

    public function eventFilter(): void {

    }

    /** @throws InvalidRequiredArgumentException */
    public function eventType(): void {
        if (!$this->expectsExtendedParameters()) return;

        $eventType = $this->params->getEventType();
        $values = HooksEventType::values();

        if (!in_array($eventType, $values)) {
            throw new InvalidRequiredArgumentException(
                "Invalid event type '$eventType'! Allowed values are "
                . implode(',', $values) . '.');
        }
    }

    private function expectsExtendedParameters(): bool {
        $action = $this->params->getAction();

        if (HooksAction::READ === $action) return false;
        if (HooksAction::UNSUBSCRIBE === $action) return false;

        return true;
    }

    /** @throws InvalidRequiredArgumentException */
    public function requestMethod(): void {
        if (!$this->expectsExtendedParameters()) return;

        $requestMethod = $this->params->getRequestMethod();
        $values = HooksRequestMethod::values();

        if (!in_array($requestMethod, $values)) {
            throw new InvalidRequiredArgumentException(
                "Invalid request method '$requestMethod'! Allowed values are "
                . implode(',', $values) . '.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function targetUrl(): void {
        if (!$this->expectsExtendedParameters()) return;

        $targetUrl = $this->params->getTargetUrl();

        if (!Util::isValidUrl($targetUrl))
            throw new InvalidRequiredArgumentException('Invalid target_url: ' . $targetUrl);
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    protected function unsubscribe(): void {
        $this->id();
    }

    /** @throws InvalidRequiredArgumentException */
    public function id(): void {
        if (HooksAction::UNSUBSCRIBE !== $this->params->getAction()) return;

        $id = $this->params->getId();

        if (!is_numeric($id))
            throw new InvalidRequiredArgumentException('Invalid ID: ' . $id);
    }
}
