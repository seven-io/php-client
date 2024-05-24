<?php declare(strict_types=1);

namespace Seven\Api\Resource\Journal;

class JournalVoice extends JournalBase {
    protected ?string $duration;
    protected ?string $error;
    protected string $status;
    protected bool $xml;

    public function __construct(object $data) {
        parent::__construct($data);

        $this->duration = $data->duration;
        $this->error = $data->error;
        $this->status = $data->status;
        $this->xml = $data->xml;
    }

    public function getDuration(): ?string {
        return $this->duration;
    }

    public function getError(): ?string {
        return $this->error;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function isXml(): bool {
        return $this->xml;
    }
}
