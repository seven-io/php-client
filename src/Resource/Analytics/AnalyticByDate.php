<?php declare(strict_types=1);

namespace Seven\Api\Resource\Analytics;

class AnalyticByDate extends AbstractAnalytic {
    protected string $date;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->date = $data->date;
    }

    public function getDate(): string {
        return $this->date;
    }
}
