<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Constant\SubaccountsAction;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\Subaccounts\SubaccountsParams;

class SubaccountsValidator
{
    protected SubaccountsParams $params;

    public function __construct(SubaccountsParams $params)
    {
        $this->params = $params;
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void
    {
        $this->action();

        switch ($this->params->getAction()) {
            case SubaccountsAction::CREATE:
                $this->create();
                break;
            case SubaccountsAction::DELETE:
                $this->delete();
                break;
            case SubaccountsAction::READ:
                $this->read();
                break;
            case SubaccountsAction::TRANSFER_CREDITS:
                $this->transferCredits();
                break;
            case SubaccountsAction::UPDATE:
                $this->update();
                break;
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function action(): void
    {
        if (!in_array($this->params->getAction(), SubaccountsAction::values()))
            throw new InvalidRequiredArgumentException('Parameter "number" is missing.');
    }

    /** @throws InvalidRequiredArgumentException */
    public function create(): void
    {
        if (!$this->params->getName())
            throw new InvalidRequiredArgumentException('Parameter "name" is missing.');

        if (!$this->params->getEmail())
            throw new InvalidRequiredArgumentException('Parameter "email" is missing.');
    }

    /** @throws InvalidRequiredArgumentException */
    public function delete(): void
    {
        if (!$this->params->getId())
            throw new InvalidRequiredArgumentException('Parameter "id" is missing or invalid.');
    }

    public function read(): void
    {
    }

    /** @throws InvalidRequiredArgumentException */
    public function transferCredits(): void
    {
        if (!$this->params->getId())
            throw new InvalidRequiredArgumentException('Parameter "id" is invalid.');

        if (!$this->params->getAmount())
            throw new InvalidRequiredArgumentException('Parameter "amount" is invalid.');
    }

    /** @throws InvalidRequiredArgumentException */
    public function update(): void
    {
        if (!$this->params->getId())
            throw new InvalidRequiredArgumentException('Parameter "id" is invalid.');

        if (!$this->params->getAmount())
            throw new InvalidRequiredArgumentException('Parameter "amount" is invalid.');

        if (!$this->params->getThreshold())
            throw new InvalidRequiredArgumentException('Parameter "threshold" is invalid.');
    }
}
