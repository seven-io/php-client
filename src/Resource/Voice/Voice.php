<?php declare(strict_types=1);

namespace Seven\Api\Resource\Voice;

class Voice {
    protected bool $debug;
    protected float $balance;
    /**
     * @var VoiceMessage[] $messages
     */
    protected array $messages;
    protected int $success;
    protected float $totalPrice;

    public function __construct(object $data) {
        $this->debug = (bool)$data->debug;
        $this->balance = (float)$data->balance;
        $this->messages = [];
        foreach ($data->messages as $k => $v) {
            $this->messages[$k] = new VoiceMessage($v);
        }
        $this->success = (int)$data->success;
        $this->totalPrice = (float)$data->total_price;
    }

    public function isDebug(): bool {
        return $this->debug;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getMessages(): array {
        return $this->messages;
    }

    public function getSuccess(): int {
        return $this->success;
    }

    public function getTotalPrice(): float {
        return $this->totalPrice;
    }
}
