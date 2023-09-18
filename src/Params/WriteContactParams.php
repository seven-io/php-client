<?php declare(strict_types=1);

namespace Seven\Api\Params;

use Seven\Api\Constant\ContactsAction;

class WriteContactParams extends ContactsParams {
    public function __construct() {
        parent::__construct(ContactsAction::WRITE);
    }
}
