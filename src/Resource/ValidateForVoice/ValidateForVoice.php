<?php declare(strict_types=1);

namespace Seven\Api\Resource\ValidateForVoice;

class ValidateForVoice {
    protected ?int $code = null;
    protected ?string $error = null;
    protected ?string $formattedOutput = null;
    protected ?int $id = null;
    protected ?string $sender = null;
    protected bool $success;
    protected bool $voice = false;

    public function __construct(object $data) {
        if (property_exists($data, 'code')) $this->code = (int)$data->code;
        if (property_exists($data, 'error')) $this->error = $data->error !== null ? (string)$data->error : null;
        if (property_exists($data, 'formatted_output'))
            $this->formattedOutput = $data->formatted_output !== null ? (string)$data->formatted_output : null;
        if (property_exists($data, 'id')) $this->id = $data->id !== null ? (int)$data->id : null;
        if (property_exists($data, 'sender')) $this->sender = $data->sender !== null ? (string)$data->sender : null;
        if (property_exists($data, 'voice')) $this->voice = (bool)$data->voice;
        $this->success = (bool)$data->success;
    }

    public function getCode(): ?int {
        return $this->code;
    }

    public function getError(): ?string {
        return $this->error;
    }

    public function getFormattedOutput(): ?string {
        return $this->formattedOutput;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getSender(): ?string {
        return $this->sender;
    }

    public function isSuccess(): bool {
        return $this->success;
    }

    public function isVoice(): bool {
        return $this->voice;
    }
}
