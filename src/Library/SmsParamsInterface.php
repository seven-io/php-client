<?php declare(strict_types=1);

namespace Sms77\Api\Library;

interface SmsParamsInterface {
    public function getDebug(): ?bool;

    public function getDelay(): ?string;

    public function getDetails(): ?bool;

    public function getFlash(): ?bool;

    public function getForeignId(): ?string;

    public function getFrom(): ?string;

    public function getJson(): ?bool;

    public function getNoReload(): ?bool;

    public function getPerformanceTracking(): ?bool;

    public function getReturnMsgId(): ?bool;

    public function getText(): string;

    public function getTo(): string;

    public function getTtl(): ?int;

    public function getUdh(): ?string;

    public function getUnicode(): ?bool;

    public function getUtf8(): ?bool;
}