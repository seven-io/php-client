<?php declare(strict_types=1);

namespace Seven\Api\Response\Pricing;

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
        $this->mcc = $data->mcc;
        $this->mncs = $data->mncs;
        $this->networkName = $data->networkName;
        $this->price = $data->price;
        $this->features = $data->features;
        $this->comment = $data->comment;
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
