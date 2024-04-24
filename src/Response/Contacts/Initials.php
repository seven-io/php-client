<?php declare(strict_types=1);

namespace Seven\Api\Response\Contacts;

class Initials
{
    protected string $color;
    protected string $initials;

    public static function fromApi(object $obj): Initials
    {
        $initials = new Initials;
        $initials->color = $obj->color;
        $initials->initials = $obj->initials;
        return $initials;
    }
}
