<?php declare(strict_types=1);

namespace Sms77\Api\Params;

interface SmsParamsInterface {
    public function getDebug(): ?bool;

    public function getDelay(): ?string;

    public function getDetails(): ?bool;

    public function getFlash(): ?bool;

    public function getForeignId(): ?string;

    public function getFrom(): ?string;

    public function getJson(): ?bool;

    public function getLabel(): ?string;

    public function getNoReload(): ?bool;

    public function getPerformanceTracking(): ?bool;

    public function getReturnMsgId(): ?bool;

    public function getText(): ?string;

    public function getTo(): ?string;

    public function getTtl(): ?int;

    public function getUdh(): ?string;

    public function getUnicode(): ?bool;

    public function getUtf8(): ?bool;

    public function setDebug(?bool $debug);

    public function setDelay(?string $delay);

    public function setDetails(?bool $details);

    public function setFlash(?bool $flash);

    public function setForeignId(?string $foreignId);

    public function setFrom(?string $from);

    public function setJson(?bool $json);

    public function setLabel(?string $label);

    public function setNoReload(?bool $noReload);

    public function setPerformanceTracking(?bool $performanceTracking);

    public function setReturnMsgId(?bool $returnMsgId);

    public function setText(string $text);

    public function setTo(string $to);

    public function setTtl(?int $ttl);

    public function setUdh(?string $udh);

    public function setUnicode(?bool $unicode);

    public function setUtf8(?bool $utf8);

    public function toArray(): array;
}