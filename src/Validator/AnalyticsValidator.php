<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Constant\AnalyticsConstants;
use Sms77\Api\Exception\InvalidOptionalArgumentException;

class AnalyticsValidator extends BaseValidator implements ValidatorInterface {
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

        if (null !== $end && !self::isValidDate($end)) {
            throw new InvalidOptionalArgumentException('end is not a valid date.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function group_by(): void {
        $groupBy = $this->fallback('group_by');

        if (null !== $groupBy && !in_array($groupBy, AnalyticsConstants::GROUP_BY, true)) {
            throw new InvalidOptionalArgumentException("Unknown group_by $groupBy.");
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function start(): void {
        $start = $this->fallback('start');

        if (null !== $start && !self::isValidDate($start)) {
            throw new InvalidOptionalArgumentException('start is not a valid date.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function subaccounts(): void {
        $invalid = false;

        $subaccounts = $this->fallback('subaccounts', '');

        if ('' !== $subaccounts
            && !in_array($subaccounts, AnalyticsConstants::SUBACCOUNTS)) {
            if (is_numeric($subaccounts)) {
                if (!is_int((int)$subaccounts)) {
                    $invalid = true;
                }
            } else {
                $invalid = true;
            }
        }

        if ($invalid) {
            $imploded = implode(',', AnalyticsConstants::SUBACCOUNTS);

            throw new InvalidOptionalArgumentException(
                "subaccounts '$subaccounts' is invalid. Valid types are: $imploded.");
        }
    }
}