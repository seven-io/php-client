<?php declare(strict_types=1);

namespace Seven\Api\Resource\Journal;

use DateTime;
use Seven\Api\Library\ParamsInterface;

class JournalParams implements ParamsInterface {
    protected ?DateTime $dateFrom = null;
    protected ?DateTime $dateTo = null;
    protected ?int $id = null;
    protected ?int $limit = null;
    protected ?string $state = null;
    protected ?string $to = null;

    public function getDateFrom(): ?DateTime {
        return $this->dateFrom;
    }

    public function setDateFrom(?DateTime $dateFrom): self {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    public function getDateTo(): ?DateTime {
        return $this->dateTo;
    }

    public function setDateTo(?DateTime $dateTo): self {
        $this->dateTo = $dateTo;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getLimit(): ?int {
        return $this->limit;
    }

    public function setLimit(?int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function setState(?string $state): self {
        $this->state = $state;
        return $this;
    }

    public function getTo(): ?string {
        return $this->to;
    }

    public function setTo(?string $to): self {
        $this->to = $to;
        return $this;
    }

    public function toArray(): array {
        $arr = get_object_vars($this);
        $format = 'Y-m-d';

        if (isset($arr['dateFrom'])) {
            /** @var DateTime $dateFrom */
            $dateFrom = $arr['dateFrom'];
            $arr['date_from'] = $dateFrom->format($format);
            unset($arr['dateFrom']);
        }

        if (isset($arr['dateTo'])) {
            /** @var DateTime $dateTo */
            $dateTo = $arr['dateTo'];
            $arr['date_to'] = $dateTo->format($format);
            unset($arr['dateTo']);
        }

        return $arr;
    }
}
