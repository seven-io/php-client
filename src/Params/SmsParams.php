<?php declare(strict_types=1);

namespace Sms77\Api\Params;

class SmsParams extends AbstractParams implements SmsParamsInterface {
    protected $debug;
    protected $delay;
    protected $details;
    protected $files;
    protected $flash;
    protected $foreign_id;
    protected $from;
    protected $json;
    protected $label;
    protected $no_reload;
    protected $performance_tracking;
    protected $return_msg_id;
    protected $text;
    protected $to;
    protected $ttl;
    protected $udh;
    protected $unicode;
    protected $utf8;

    public function getDebug(): ?bool {
        return $this->debug;
    }

    public function setDebug(?bool $debug): self {
        $this->debug = $debug;

        return $this;
    }

    public function getDelay(): ?string {
        return $this->delay;
    }

    public function setDelay(?string $delay): self {
        $this->delay = $delay;

        return $this;
    }

    public function getDetails(): ?bool {
        return $this->details;
    }

    public function setDetails(?bool $details): self {
        $this->details = $details;

        return $this;
    }

    public function addFile(array $file): self {
        $this->files[] = $file;

        return $this;
    }

    public function getFiles(): array {
        return $this->files;
    }

    public function setFiles(array $files): self {
        $this->files = $files;

        return $this;
    }

    public function removeFile(int $index): self {
        unset($this->files[$index]);

        return $this;
    }

    public function removeFiles(): self {
        $this->files = null;

        return $this;
    }

    public function getFlash(): ?bool {
        return $this->flash;
    }

    public function setFlash(?bool $flash): self {
        $this->flash = $flash;

        return $this;
    }

    public function getForeignId(): ?string {
        return $this->foreign_id;
    }

    public function setForeignId(?string $foreign_id): self {
        $this->foreign_id = $foreign_id;

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

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $label): self {
        $this->label = $label;

        return $this;
    }

    public function getNoReload(): ?bool {
        return $this->no_reload;
    }

    public function setNoReload(?bool $no_reload): self {
        $this->no_reload = $no_reload;

        return $this;
    }

    public function getPerformanceTracking(): ?bool {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(?bool $performance_tracking): self {
        $this->performance_tracking = $performance_tracking;

        return $this;
    }

    public function getReturnMsgId(): ?bool {
        return $this->return_msg_id;
    }

    public function setReturnMsgId(?bool $return_msg_id): self {
        $this->return_msg_id = $return_msg_id;

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

    public function getTtl(): ?int {
        return $this->ttl;
    }

    public function setTtl(?int $ttl): self {
        $this->ttl = $ttl;

        return $this;
    }

    public function getUdh(): ?string {
        return $this->udh;
    }

    public function setUdh(?string $udh): self {
        $this->udh = $udh;

        return $this;
    }

    public function getUnicode(): ?bool {
        return $this->unicode;
    }

    public function setUnicode(?bool $unicode): self {
        $this->unicode = $unicode;

        return $this;
    }

    public function getUtf8(): ?bool {
        return $this->utf8;
    }

    public function setUtf8(?bool $utf8): self {
        $this->utf8 = $utf8;

        return $this;
    }
}