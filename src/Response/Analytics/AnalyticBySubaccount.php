<?php declare(strict_types=1);

namespace Seven\Api\Response\Analytics;

class AnalyticBySubaccount extends AbstractAnalytic {
    protected string $account;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->account = $data->account;
    }

    public function getAccount(): string {
        return $this->account;
    }
}
