<?php declare(strict_types=1);

namespace Seven\Api\Resource\Analytics;

abstract class AbstractAnalytic {
    protected int $hlr;
    protected int $inbound;
    protected int $mnp;
    protected int $rcs;
    protected int $sms;
    protected float $usageEuro;
    protected int $voice;

    public function __construct(object $data) {
        $this->hlr = $data->hlr;
        $this->inbound = $data->inbound;
        $this->mnp = $data->mnp;
        $this->rcs = $data->rcs;
        $this->sms = $data->sms;
        $this->usageEuro = (float)$data->usage_eur;
        $this->voice = $data->voice;
    }

    public function getHLR(): int {
        return $this->hlr;
    }

    public function getInbound(): int {
        return $this->inbound;
    }

    public function getMNP(): int {
        return $this->mnp;
    }

    public function getSMS(): int {
        return $this->sms;
    }

    public function getUsageEuro(): float {
        return $this->usageEuro;
    }

    public function getVoice(): int {
        return $this->voice;
    }

    public function getRCS(): int {
        return $this->rcs;
    }
}
