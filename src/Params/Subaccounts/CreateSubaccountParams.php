<?php declare(strict_types=1);

namespace Seven\Api\Params\Subaccounts;

use Seven\Api\Constant\SubaccountsAction;

class CreateSubaccountParams extends SubaccountsParams
{
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        parent::__construct(SubaccountsAction::CREATE);
    }
}
