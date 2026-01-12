<?php declare(strict_types=1);

namespace Seven\Api\Resource\Analytics;

class AnalyticByLabel extends AbstractAnalytic {
    protected string $label;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->label = (string)$data->label;
    }

    public function getLabel(): string {
        return $this->label;
    }
}
