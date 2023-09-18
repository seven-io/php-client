<?php declare(strict_types=1);

namespace Seven\Api\Response\Sms;

class Sms {
    protected float $balance;
    protected bool $debug;
    /**
     * @var SmsMessage[] $messages
     */
    protected array $messages;
    protected string $smsType;
    protected int $success;
    protected float $totalPrice;

    public function __construct(object $data) {
        $this->balance = $data->balance;
        $this->debug = $data->debug === 'true';
        foreach ($data->messages as $k => $v) $this->messages[$k] = new SmsMessage($v);
        $this->smsType = $data->sms_type;
        $this->success = (int)$data->success;
        $this->totalPrice = $data->total_price;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function isDebug(): bool {
        return $this->debug;
    }

    public function getMessages(): array {
        return $this->messages;
    }

    public function getSmsType(): string {
        return $this->smsType;
    }

    public function getSuccess(): int {
        return $this->success;
    }

    public function getTotalPrice(): float {
        return $this->totalPrice;
    }
}
