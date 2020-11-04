<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class HooksValidator extends BaseValidator implements ValidatorInterface {
    public const ACTION_READ = 'read';
    public const ACTION_WRITE = 'write';
    public const ACTION_DEL = 'del';
    public const ACTIONS = [self::ACTION_READ, self::ACTION_DEL, self::ACTION_WRITE];

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->action();
        $this->json();
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void {
        $action = $this->fallback('action');

        if (!in_array($action, self::ACTIONS)) {
            throw new InvalidRequiredArgumentException("Unknown action '$action'.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function json(): void {
        $json = $this->fallback('json');

        if (null !== $json && !$this->isValidBool($json)) {
            throw new InvalidOptionalArgumentException('json must be 1 or 0.');
        }
    }
}