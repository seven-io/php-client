<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use DateTime;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\JournalParams;

class JournalValidator {
    public const LIMIT_MIN = 1;
    public const LIMIT_MAX = 100;

    public function __construct(protected JournalParams $params) {
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->id();
        $this->limit();
        $this->dateFrom();
        $this->dateTo();
        $this->to();
        $this->state();
    }

    /** @throws InvalidOptionalArgumentException */
    public function id(): void {
        $id = $this->params->getId();
        if ($id === null) return;

        if ($id < 1)
            throw new InvalidOptionalArgumentException('ID must be greater than 0.');
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function limit(): void {
        $limit = $this->params->getLimit();
        if ($limit === null) return;

        if ($limit < self::LIMIT_MIN) throw new InvalidOptionalArgumentException(
            'Limit can not be less than ' . self::LIMIT_MIN
        );

        if ($limit > self::LIMIT_MAX) throw new InvalidOptionalArgumentException(
            'Limit can not be more than ' . self::LIMIT_MAX
        );
    }

    /** @throws InvalidOptionalArgumentException */
    public function dateFrom(): void {
        $dateFrom = $this->params->getDateFrom();
        if (!$dateFrom) return;

        if ($dateFrom > new DateTime)
            throw new InvalidOptionalArgumentException('From date can not be in the future.');
    }

    /** @throws InvalidOptionalArgumentException */
    public function dateTo(): void {
        $dateTo = $this->params->getDateTo();
        if (!$dateTo) return;

        if ($dateTo > new DateTime)
            throw new InvalidOptionalArgumentException('To date can not be in the future.');
    }

    /** @throws InvalidOptionalArgumentException */
    public function to(): void {
        $to = $this->params->getTo();
        if (!$to) return;

        if (!(preg_match('/\\d/', $to)))
            throw new InvalidOptionalArgumentException('to is not a valid number.');
    }

    public function state(): void {
    }
}
