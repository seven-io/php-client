<?php declare(strict_types=1);

namespace Seven\Api\Resource\Contacts;

class Initials {
    protected string $color;
    protected string $initials;

    public static function fromApi(object $obj): Initials {
        $initials = new Initials;
        $initials->color = (string)$obj->color;
        $initials->initials = (string)$obj->initials;
        return $initials;
    }
}
