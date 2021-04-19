<?php declare(strict_types=1);

namespace Sms77\Api\Params;

interface VoiceParamsInterface {
    public function getFrom(): ?string;

    public function getJson(): ?bool;

    public function getXml(): ?bool;

    public function getText(): ?string;

    public function getTo(): ?string;

    public function setJson(?bool $json);

    public function setFrom(?string $from);

    public function setXml(?bool $xml);

    public function setText(string $text);

    public function setTo(string $to);

    public function toArray(): array;
}