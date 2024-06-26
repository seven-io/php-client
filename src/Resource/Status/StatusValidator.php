<?php declare(strict_types=1);

namespace Seven\Api\Resource\Status;

use Seven\Api\Exception\InvalidRequiredArgumentException;

class StatusValidator {
    protected StatusParams $params;

    public function __construct(StatusParams $params) {
        $this->params = $params;
    }

    /** @throws InvalidRequiredArgumentException */
    public function validate(): void {
        $this->messageIds();
    }

    /** @throws InvalidRequiredArgumentException */
    public function messageIds(): void {
        foreach ($this->params->getMessageIds() as $messageId)
            if (0 === $messageId || !is_numeric($messageId))
                throw new InvalidRequiredArgumentException('Parameter "msg_id" is invalid.');
    }
}
