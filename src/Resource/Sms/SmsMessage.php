<?php declare(strict_types=1);

namespace Seven\Api\Resource\Sms;

class SmsMessage {
    protected string $encoding;
    protected ?int $error = null;
    protected ?string $errorText = null;
    protected ?int $id = null;
    protected bool $isBinary;
    protected ?string $label;
    protected int $parts;
    protected float $price;
    protected ?string $recipient;
    protected string $sender;
    protected bool $success;
    protected string $text;
    protected ?string $udh;

    public function __construct(object $data) {
        $this->encoding = (string)$data->encoding;
        $this->error = $data->error !== null ? (int)$data->error : null;
        $this->errorText = $data->error_text !== null ? (string)$data->error_text : null;
        $this->id = $data->id !== null ? (int)$data->id : null;
        $this->isBinary = (bool)$data->is_binary;
        $this->label = property_exists($data, 'label') && $data->label !== null ? (string)$data->label : null;
        $this->parts = (int)$data->parts;
        $this->price = (float)$data->price;
        $this->recipient = $data->recipient !== null ? (string)$data->recipient : null;
        $this->sender = (string)$data->sender;
        $this->success = (bool)$data->success;
        $this->text = (string)$data->text;
        $this->udh = $data->udh !== null ? (string)$data->udh : null;
    }

    public function getEncoding(): string {
        return $this->encoding;
    }

    public function getError(): ?int {
        return $this->error;
    }

    public function getErrorText(): ?string {
        return $this->errorText;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getParts(): int {
        return $this->parts;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getRecipient(): ?string {
        return $this->recipient;
    }

    public function getSender(): string {
        return $this->sender;
    }

    public function isSuccess(): bool {
        return $this->success;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getUdh(): ?string {
        return $this->udh;
    }

    public function getIsBinary(): bool {
        return $this->isBinary;
    }
}
