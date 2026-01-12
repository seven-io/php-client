<?php declare(strict_types=1);

namespace Seven\Api\Resource\Journal;

abstract class JournalBase {
    protected string $from;
    protected string $id;
    protected float $price;
    protected string $text;
    protected string $timestamp;
    protected string $to;

    public function __construct(object $data) {
        $this->from = (string)$data->from;
        $this->id = (string)$data->id;
        $this->price = (float)$data->price;
        $this->text = (string)$data->text;
        $this->timestamp = (string)$data->timestamp;
        $this->to = (string)$data->to;
    }

    public function getFrom(): string {
        return $this->from;
    }

    public function getTo(): string {
        return $this->to;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getTimestamp(): string {
        return $this->timestamp;
    }
}
