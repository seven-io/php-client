<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use DateTime;
use Seven\Api\Constant\AnalyticsSubaccounts;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Params\AnalyticsParams;

class AnalyticsValidator {
    protected AnalyticsParams $params;

    public function __construct(AnalyticsParams $params) {
        $this->params = $params;
    }

    /** @throws InvalidOptionalArgumentException */
    public function validate(): void {
        $this->end();
        $this->label();
        $this->start();
        $this->subaccounts();
    }

    /** @throws InvalidOptionalArgumentException */
    public function end(): void {
        $end = $this->params->getEnd();
        if (!$end) return;

        if ($end > new DateTime)
            throw new InvalidOptionalArgumentException('end date can not be in the future.');

        $start = $this->params->getStart();
        if ($start && $start > $end)
            throw new InvalidOptionalArgumentException('start date can not be past end date.');
    }

    public function label(): void {
    }

    /** @throws InvalidOptionalArgumentException */
    public function start(): void {
        $start = $this->params->getStart();
        if (!$start) return;

        if ($start > new DateTime)
            throw new InvalidOptionalArgumentException('start date can not be in the future.');
    }

    /** @throws InvalidOptionalArgumentException */
    public function subaccounts(): void {
        $subaccounts = $this->params->getSubaccounts();
        if (!$subaccounts) return;

        $invalid = false;
        $values = AnalyticsSubaccounts::values();

        if (!in_array($subaccounts, $values)) {
            if (is_numeric($subaccounts)) {
                if (!is_int((int)$subaccounts)) $invalid = true;
            } else $invalid = true;
        }

        if ($invalid) {
            $imploded = implode(',', [...$values, '<ID>']);
            throw new InvalidOptionalArgumentException(
                "subaccounts '$subaccounts' is invalid. Valid types are: $imploded.");
        }
    }
}
