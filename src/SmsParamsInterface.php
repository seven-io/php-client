<?php

namespace Sms77\Api;

interface SmsParamsInterface {
    /** @return bool|null */
    public function getDebug();

    /** @return string|null */
    public function getDelay();

    /** @return bool|null */
    public function getDetails();

    /** @return bool|null */
    public function getFlash();

    /** @return bool|null */
    public function getForeignId();

    /** @return string|null */
    public function getFrom();

    /** @return bool|null */
    public function getJson();

    /** @return bool|null */
    public function getNoReload();

    /** @return bool|null */
    public function getPerformanceTracking();

    /** @return bool|null */
    public function getReturnMsgId();

    /** @return string */
    public function getText();

    /** @return string */
    public function getTo();

    /** @return int|null */
    public function getTtl();

    /** @return string|null */
    public function getUdh();

    /** @return bool|null */
    public function getUnicode();

    /** @return bool|null */
    public function getUtf8();
}