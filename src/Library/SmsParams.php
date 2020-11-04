<?php declare(strict_types=1);

namespace Sms77\Api\Library;

class SmsParams implements SmsParamsInterface {
    protected $debug = false;
    protected $delay;
    protected $details = false;
    protected $flash = false;
    protected $foreign_id;
    protected $from;
    protected $json = false;
    protected $no_reload = false;
    protected $performance_tracking = false;
    protected $return_msg_id = false;
    protected $text;
    protected $to;
    protected $ttl;
    protected $udh;
    protected $unicode = false;
    protected $utf8 = false;

    public function getDebug(): ?bool {
        return $this->debug;
    }

    public function setDebug(bool $debug): void {
        $this->debug = $debug;
    }

    public function getDelay(): ?string {
        return $this->delay;
    }

    public function setDelay(?string $delay): void {
        $this->delay = $delay;
    }

    public function getDetails(): ?bool {
        return $this->details;
    }

    public function setDetails(bool $details): void {
        $this->details = $details;
    }

    public function getFlash(): ?bool {
        return $this->flash;
    }

    public function setFlash(bool $flash): void {
        $this->flash = $flash;
    }

    public function getForeignId(): ?string {
        return $this->foreign_id;
    }

    public function setForeignId(?string $foreign_id): void {
        $this->foreign_id = $foreign_id;
    }

    public function getFrom(): ?string {
        return $this->from;
    }

    public function setFrom(?string $from): void {
        $this->from = $from;
    }

    public function getJson(): ?bool {
        return $this->json;
    }

    public function setJson(bool $json): void {
        $this->json = $json;
    }

    public function getNoReload(): ?bool {
        return $this->no_reload;
    }

    public function setNoReload(bool $no_reload): void {
        $this->no_reload = $no_reload;
    }

    public function getPerformanceTracking(): ?bool {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(bool $performance_tracking): void {
        $this->performance_tracking = $performance_tracking;
    }

    public function getReturnMsgId(): ?bool {
        return $this->return_msg_id;
    }

    public function setReturnMsgId(bool $return_msg_id): void {
        $this->return_msg_id = $return_msg_id;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setText(string $text): void {
        $this->text = $text;
    }

    public function getTo(): string {
        return $this->to;
    }

    public function setTo(?string $to): void {
        $this->to = $to;
    }

    public function getTtl(): ?int {
        return $this->ttl;
    }

    public function setTtl(int $ttl): void {
        $this->ttl = $ttl;
    }

    public function getUdh(): ?string {
        return $this->udh;
    }

    public function setUdh(?string $udh): void {
        $this->udh = $udh;
    }

    public function getUnicode(): ?bool {
        return $this->unicode;
    }

    public function setUnicode(bool $unicode): void {
        $this->unicode = $unicode;
    }

    public function getUtf8(): ?bool {
        return $this->utf8;
    }

    public function setUtf8(bool $utf8): void {
        $this->utf8 = $utf8;
    }
}