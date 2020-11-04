<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;

class AnalyticsValidator extends BaseValidator implements ValidatorInterface {
    public const GROUP_BY = ['date', 'country', 'label', 'subaccount'];
    public const SUBACCOUNTS = ['only_main', 'all'];

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->end();
        $this->group_by();
        $this->start();
        $this->subaccounts();
    }

    /** @throws InvalidOptionalArgumentException */
    public function end(): void {
        $end = $this->fallback('end');

        if (null !== $end && !$this->isValidDate($end)) {
            throw new InvalidOptionalArgumentException('end is not a valid date.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function group_by(): void {
        $groupBy = $this->fallback('group_by');

        if (null !== $groupBy && !in_array($groupBy, self::GROUP_BY, true)) {
            throw new InvalidOptionalArgumentException("Unknown group_by $groupBy.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function start(): void {
        $start = $this->fallback('start');

        if (null !== $start && !$this->isValidDate($start)) {
            throw new InvalidOptionalArgumentException('start is not a valid date.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function subaccounts(): void {
        $invalid = false;

        $subaccounts = $this->fallback('subaccounts', '');

        if ('' !== $subaccounts && !in_array($subaccounts, self::SUBACCOUNTS)) {
            if (is_numeric($subaccounts)) {
                if (!is_int((int)$subaccounts)) {
                    $invalid = true;
                }
            } else {
                $invalid = true;
            }
        }

        if ($invalid) {
            $imploded = implode(',', self::SUBACCOUNTS);

            throw new InvalidOptionalArgumentException(
                "subaccounts '$subaccounts' is invalid. Valid types are: $imploded.");
        }
    }
}