<?php declare(strict_types=1);

namespace Seven\Api\Resource\Lookup;

class LookupRcsCapabilities extends LookupFormat {
    /** @var string[] $rcsCapabilities */
    protected array $rcsCapabilities;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->rcsCapabilities = $data->rcs_capabilities;
    }
}
