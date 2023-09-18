<?php declare(strict_types=1);

namespace Seven\Api\Params;

class StatusParams implements ParamsInterface {
    protected array $messageIds;

    public function __construct(int ...$messageIds) {
        $this->messageIds = $messageIds;
    }

    public function getMessageIds(): array {
        return $this->messageIds;
    }

    public function setMessageIds(array $messageIds): self {
        $this->messageIds = $messageIds;
        return $this;
    }

    public function toArray(): array {
        $arr = get_object_vars($this);
        $arr['msg_id'] = implode(',', $arr['messageIds']);
        unset($arr['messageIds']);

        return $arr;
    }
}
