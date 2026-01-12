<?php declare(strict_types=1);

namespace Seven\Api\Resource\Voice;

class VoiceMessage {
    protected ?string $error;
    protected ?string $errorText;
    protected int $id;
    protected float $price;
    protected string $recipient;
    protected string $sender;
    protected bool $success;
    protected string $text;

    public function __construct(object $data) {
        $this->error = $data->error !== null ? (string)$data->error : null;
        $this->errorText = $data->error_text !== null ? (string)$data->error_text : null;
        $this->id = (int)$data->id;
        $this->price = (float)$data->price;
        $this->recipient = (string)$data->recipient;
        $this->sender = (string)$data->sender;
        $this->success = (bool)$data->success;
        $this->text = (string)$data->text;
    }

    public function getError(): ?string {
        return $this->error;
    }

    public function getErrorText(): ?string {
        return $this->errorText;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getRecipient(): string {
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
}
