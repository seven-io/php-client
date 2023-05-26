<?php declare(strict_types=1);

namespace Sms77\Api\Params;

class VoiceParams extends AbstractParams implements VoiceParamsInterface {
    protected $debug;
    protected $from;
    protected $json;
    protected $language;
    protected $text;
    protected $to;
    protected $xml;

    public function getDebug(): ?bool {
        return $this->debug;
    }

    public function setDebug(?bool $debug): self {
        $this->debug = $debug;

        return $this;
    }

    public function getFrom(): ?string {
        return $this->from;
    }

    public function setFrom(?string $from): self {
        $this->from = $from;

        return $this;
    }

    public function getJson(): ?bool {
        return $this->json;
    }

    public function setJson(?bool $json): self {
        $this->json = $json;

        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(string $text): self {
        $this->text = $text;

        return $this;
    }

    public function getTo(): ?string {
        return $this->to;
    }

    public function setTo(string $to): self {
        $this->to = $to;

        return $this;
    }

    public function getXml(): ?bool {
        return $this->xml;
    }

    public function setXml(?bool $xml): self {
        $this->xml = $xml;

        return $this;
    }

    public function getLanguage(): ?string {
        return $this->language;
    }

    public function setLanguage(?string $language): self {
        $this->language = $language;

        return $this;
    }
}
