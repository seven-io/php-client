<?php declare(strict_types=1);

namespace Seven\Api\Resource\Pricing;

class Network {
    protected ?string $comment;
    /**
     * @var string[] $features
     */
    protected array $features;
    protected string $mcc;
    /**
     * @var string[]|null $mncs
     */
    protected ?array $mncs;
    protected ?string $networkName;
    protected float $price;

    public function __construct(object $data) {
        $this->mcc = (string)$data->mcc;
        $this->mncs = $data->mncs !== null ? (array)$data->mncs : null;
        $this->networkName = $data->networkName !== null ? (string)$data->networkName : null;
        $this->price = (float)$data->price;
        $this->features = (array)$data->features;
        $this->comment = $data->comment !== null ? (string)$data->comment : null;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function getFeatures(): array {
        return $this->features;
    }

    public function getMcc(): string {
        return $this->mcc;
    }

    public function getMncs(): ?array {
        return $this->mncs;
    }

    public function getNetworkName(): ?string {
        return $this->networkName;
    }

    public function getPrice(): float {
        return $this->price;
    }
}
