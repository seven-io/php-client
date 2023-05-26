<?php declare(strict_types=1);

namespace Sms77\Api\Params;

interface VoiceParamsInterface {
    public function getDebug(): ?bool;

    public function getFrom(): ?string;

    public function getLanguage(): ?string;

    public function getJson(): ?bool;

    public function getText(): ?string;

    public function getTo(): ?string;

    public function getXml(): ?bool;

    public function setDebug(?bool $debug);

    public function setFrom(?string $from);

    public function setJson(?bool $json);

    public function setLanguage();

    public function setText(string $text);

    public function setTo(string $to);

    public function setXml(?bool $xml);

    public function toArray(): array;
}
