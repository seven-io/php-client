<?php declare(strict_types=1);

namespace Seven\Api\Resource\Analytics;

class AnalyticBySubaccount extends AbstractAnalytic {
    protected string $account;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->account = (string)$data->account;
    }

    public function getAccount(): string {
        return $this->account;
    }
}
