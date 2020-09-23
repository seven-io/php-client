<?php

namespace Sms77\Api;

class SmsParams implements SmsParamsInterface {
    protected $debug = 0;
    protected $delay = 0;
    protected $details = 0;
    protected $flash = 0;
    protected $foreign_id;
    protected $from;
    protected $json = 0;
    protected $no_reload = 0;
    protected $performance_tracking = 0;
    protected $return_msg_id = 0;
    protected $text;
    protected $to;
    protected $ttl;
    protected $udh;
    protected $unicode = 0;
    protected $utf8 = 0;

    /** @inheritDoc */
    public function getDebug() {
        return $this->debug;
    }

    /** @param int $debug */
    public function setDebug($debug) {
        $this->debug = $debug;
    }

    /** @inheritDoc */
    public function getDelay() {
        return $this->delay;
    }

    /** @param int $delay */
    public function setDelay($delay) {
        $this->delay = $delay;
    }

    /** @inheritDoc */
    public function getDetails() {
        return $this->details;
    }

    /** @param int $details */
    public function setDetails($details) {
        $this->details = $details;
    }

    /** @inheritDoc */
    public function getFlash() {
        return $this->flash;
    }

    /** @param int $flash */
    public function setFlash($flash) {
        $this->flash = $flash;
    }

    /** @inheritDoc */
    public function getForeignId() {
        return $this->foreign_id;
    }

    /** @param mixed $foreign_id */
    public function setForeignId($foreign_id) {
        $this->foreign_id = $foreign_id;
    }

    /** @inheritDoc */
    public function getFrom() {
        return $this->from;
    }

    /** @param mixed $from */
    public function setFrom($from) {
        $this->from = $from;
    }

    /** @inheritDoc */
    public function getJson() {
        return $this->json;
    }

    /** @param int $json */
    public function setJson($json) {
        $this->json = $json;
    }

    /** @inheritDoc */
    public function getNoReload() {
        return $this->no_reload;
    }

    /** @param int $no_reload */
    public function setNoReload($no_reload) {
        $this->no_reload = $no_reload;
    }

    /** @inheritDoc */
    public function getPerformanceTracking() {
        return $this->performance_tracking;
    }

    /** @param int $performance_tracking */
    public function setPerformanceTracking($performance_tracking) {
        $this->performance_tracking = $performance_tracking;
    }

    /** @inheritDoc */
    public function getReturnMsgId() {
        return $this->return_msg_id;
    }

    /** @param int $return_msg_id */
    public function setReturnMsgId($return_msg_id) {
        $this->return_msg_id = $return_msg_id;
    }

    /** @inheritDoc */
    public function getText() {
        return $this->text;
    }

    /** @param string $text */
    public function setText($text) {
        $this->text = $text;
    }

    /** @inheritDoc */
    public function getTo() {
        return $this->to;
    }

    /** @param string $to */
    public function setTo($to) {
        $this->to = $to;
    }

    /** @inheritDoc */
    public function getTtl() {
        return $this->ttl;
    }

    /** @param mixed $ttl */
    public function setTtl($ttl) {
        $this->ttl = $ttl;
    }

    /** @inheritDoc */
    public function getUdh() {
        return $this->udh;
    }

    /** @param mixed $udh */
    public function setUdh($udh) {
        $this->udh = $udh;
    }

    /** @inheritDoc */
    public function getUnicode() {
        return $this->unicode;
    }

    /** @param int $unicode */
    public function setUnicode($unicode) {
        $this->unicode = $unicode;
    }

    /** @inheritDoc */
    public function getUtf8() {
        return $this->utf8;
    }

    /** @param int $utf8 */
    public function setUtf8($utf8) {
        $this->utf8 = $utf8;
    }
}