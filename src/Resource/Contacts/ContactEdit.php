<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class ContactEdit {
    protected int $return;

    public function __construct(object $data) {
        $this->return = (int)$data->return;
    }

    public function getReturn(): int {
        return $this->return;
    }
}
