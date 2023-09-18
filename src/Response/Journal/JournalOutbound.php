<?php declare(strict_types=1);

namespace Seven\Api\Response\Journal;

class JournalOutbound extends JournalBase {
    protected string $connection;
    protected ?string $dlr;
    protected ?string $dlrTimestamp;
    protected ?string $foreignId;
    protected ?string $label;
    protected ?string $latency;
    protected ?string $mccMnc;
    protected string $type;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->connection = $data->connection;
        $this->dlr = $data->dlr;
        $this->dlrTimestamp = $data->dlr_timestamp;
        $this->foreignId = $data->foreign_id;
        $this->label = $data->label;
        $this->latency = $data->latency;
        $this->mccMnc = $data->mccmnc;
        $this->type = $data->type;
    }

    public function getConnection(): string {
        return $this->connection;
    }

    public function getDlr(): ?string {
        return $this->dlr;
    }

    public function getDlrTimestamp(): ?string {
        return $this->dlrTimestamp;
    }

    public function getForeignId(): ?string {
        return $this->foreignId;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function getLatency(): ?string {
        return $this->latency;
    }

    public function getMccMnc(): ?string {
        return $this->mccMnc;
    }

    public function getType(): string {
        return $this->type;
    }
}
