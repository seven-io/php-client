<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\JournalConstants;
use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class JournalValidator extends BaseValidator implements ValidatorInterface {
    /** @throws InvalidOptionalArgumentException|InvalidRequiredArgumentException */
    public function validate(): void {
        $this->type();
        $this->id();
        $this->date_from();
        $this->date_to();
        $this->to();
        $this->state();
    }

    /** @throws InvalidRequiredArgumentException */
    public function type(): void {
        $type = $this->fallback('type');

        if (!in_array($type, JournalConstants::TYPES)) {
            throw new InvalidRequiredArgumentException('missing type.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function id(): void {
        $id = $this->fallback('id');

        if (null !== $id && !is_int($id)) {
            throw new InvalidOptionalArgumentException("Invalid type for id $id.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function date_from(): void {
        $dateFrom = $this->fallback('date_from');

        if (null !== $dateFrom && !self::isDateValid($dateFrom)) {
            throw new InvalidOptionalArgumentException(
                'date_from is not a valid date.');
        }
    }

    public static function isDateValid(string $date): bool {
        return (bool)preg_match(JournalConstants::DATE_PATTERN, $date);
    }

    /** @throws InvalidOptionalArgumentException */
    public function date_to(): void {
        $dateTo = $this->fallback('date_to');

        if (null !== $dateTo && !self::isDateValid($dateTo)) {
            throw new InvalidOptionalArgumentException(
                'date_to is not a valid date.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function to(): void {
        $to = $this->fallback('to');

        if (null !== $to && !((bool)preg_match('/\\d/', $to))) {
            throw new InvalidOptionalArgumentException('to is not a valid number.');
        }
    }

    public function state(): void {
    }
}