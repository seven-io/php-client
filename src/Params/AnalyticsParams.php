<?php declare(strict_types=1);

namespace Seven\Api\Params;

use DateTime;

class AnalyticsParams implements ParamsInterface {
    protected ?DateTime $end = null;
    protected ?string $label = null;
    protected ?DateTime $start = null;
    protected ?string $subaccounts = null;

    public function toArray(): array {
        $arr = get_object_vars($this);

        if (isset($arr['groupBy'])) {
            $arr['group_by'] = $arr['groupBy'];
            unset($arr['groupBy']);
        }

        return $arr;
    }

    public function getStart(): ?DateTime {
        return $this->start;
    }

    public function setStart(?DateTime $start): self {
        $this->start = $start;
        return $this;
    }

    public function getEnd(): ?DateTime {
        return $this->end;

    }

    public function setEnd(?DateTime $end): self {
        $this->end = $end;
        return $this;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $label): self {
        $this->label = $label;
        return $this;
    }

    public function getSubaccounts(): ?string {
        return $this->subaccounts;
    }

    public function setSubaccounts(?string $subaccounts): self {
        $this->subaccounts = $subaccounts;
        return $this;
    }
}
