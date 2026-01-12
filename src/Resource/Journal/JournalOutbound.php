<?php declare(strict_types=1);

namespace Seven\Api\Resource\Journal;

class JournalOutbound extends JournalBase {
    protected string $channel;
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

        $this->channel = (string)$data->channel;
        $this->connection = (string)$data->connection;
        $this->dlr = $data->dlr !== null ? (string)$data->dlr : null;
        $this->dlrTimestamp = $data->dlr_timestamp !== null ? (string)$data->dlr_timestamp : null;
        $this->foreignId = $data->foreign_id !== null ? (string)$data->foreign_id : null;
        $this->label = $data->label !== null ? (string)$data->label : null;
        $this->latency = $data->latency !== null ? (string)$data->latency : null;
        $this->mccMnc = $data->mccmnc !== null ? (string)$data->mccmnc : null;
        $this->type = (string)$data->type;
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

    public function getChannel(): string {
        return $this->channel;
    }
}
