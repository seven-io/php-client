<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\HooksConstants;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Library\Util;

class HooksValidator extends BaseValidator implements ValidatorInterface {
    /** @var string|null $action */
    private $action;

    /** @var int|null $id */
    private $id;

    /** @throws InvalidRequiredArgumentException */
    public function validate(): void {
        $this->action();
        $this->event_type();
        $this->id();
        $this->request_method();
        $this->target_url();
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $this->action = $this->fallback('action');

        if (!in_array($this->action, HooksConstants::ACTIONS)) {
            throw new InvalidRequiredArgumentException(
                "Unknown action '$this->action'!");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function event_type(): void {
        if (!$this->expectsExtendedParameters()) {
            return;
        }

        $eventType = $this->fallback('event_type');

        if (!in_array($eventType, HooksConstants::EVENT_TYPES)) {
            throw new InvalidRequiredArgumentException(
                "Invalid event_type '$eventType'! Allowed values are "
                . implode(',', HooksConstants::EVENT_TYPES) . '.');
        }
    }

    private function expectsExtendedParameters(): bool {
        if (HooksConstants::ACTION_READ === $this->action) {
            return false;
        }

        if (HooksConstants::ACTION_UNSUBSCRIBE === $this->action) {
            return false;
        }

        return true;
    }

    /** @throws InvalidRequiredArgumentException */
    public function id(): void {
        if (HooksConstants::ACTION_UNSUBSCRIBE !== $this->action) {
            return;
        }

        $this->id = $this->fallback('id');

        if (!is_numeric($this->id)) {
            throw new InvalidRequiredArgumentException("Invalid ID '$this->id'!");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function request_method(): void {
        if (!$this->expectsExtendedParameters()) {
            return;
        }

        $requestMethod = $this->fallback('request_method');

        if (!in_array($requestMethod, HooksConstants::REQUEST_METHODS)) {
            throw new InvalidRequiredArgumentException(
                "Invalid request_method '$requestMethod'! Allowed values are "
                . implode(',', HooksConstants::REQUEST_METHODS) . '.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function target_url(): void {
        if (!$this->expectsExtendedParameters()) {
            return;
        }

        $targetUrl = $this->fallback('target_url');

        if (!Util::isValidUrl($targetUrl)) {
            throw new InvalidRequiredArgumentException(
                "Invalid target_url '$targetUrl'!");
        }
    }
}