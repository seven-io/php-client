<?php declare(strict_types=1);

namespace Seven\Api\Resource\Status;

use Seven\Api\Library\ParamsInterface;

class StatusParams implements ParamsInterface
{
    /** @var int[] $messageIds */
    protected array $messageIds;

    public function __construct(int ...$messageIds)
    {
        $this->messageIds = $messageIds;
    }

    public function getMessageIds(): array
    {
        return $this->messageIds;
    }

    public function addMessageIds(int ...$messageIds): self
    {
        array_push($this->messageIds, ...$messageIds);
        return $this;
    }

    public function toArray(): array
    {
        $arr = get_object_vars($this);

        $arr['msg_id'] = implode(',', $arr['messageIds']);

        unset($arr['messageIds']);

        return $arr;
    }
}
