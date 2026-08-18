<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

enum RcsSuggestionType: string
{
    case REPLY = 'reply';
    case DIAL = 'dial';
    case VIEW_LOCATION = 'viewLocation';
    case CREATE_CALENDAR_EVENT = 'createCalendarEvent';
    case OPEN_URL = 'openUrl';
    case SHARE_LOCATION = 'shareLocation';
}
