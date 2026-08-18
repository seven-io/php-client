<?php declare(strict_types=1);

namespace Seven\Api\Resource\Rcs;

use Datetime;
use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Resource\Sms\SmsConstants;

class RcsValidator {
    private const MAX_ROOT_SUGGESTIONS = 11;
    private const MAX_RICHCARD_SUGGESTIONS = 4;

    public function __construct(protected RcsParams $params) {
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->delay();
        $this->fallback();
        $this->foreign_id();
        $this->from();
        $this->label();
        $this->content();
        $this->suggestions();
        $this->to();
        $this->ttl();
    }

    /** @throws InvalidOptionalArgumentException */
    public function delay(): void {
        $delay = $this->params->getDelay();

        if (!$delay) return;

        if ($delay < new DateTime)
            throw new InvalidOptionalArgumentException('Delay must be a value from the future');
    }

    /** @throws InvalidRequiredArgumentException */
    public function fallback(): void {
        $fallback = $this->params->getFallback();

        if (!$fallback instanceof RcsFallbackParams) {
            return;
        }

        if (RcsFallbackType::SMS === $fallback->getType() && '' === trim((string)$fallback->getText())) {
            throw new InvalidRequiredArgumentException('An SMS fallback object requires text.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function foreign_id(): void {
        $foreignId = $this->params->getForeignId();

        if (null === $foreignId || '' === $foreignId) {
            return;
        }

        $maxLength = SmsConstants::FOREIGN_ID_MAX_LENGTH;
        if (mb_strlen($foreignId) > $maxLength) {
            throw new InvalidOptionalArgumentException(
                "foreign_id must not exceed '$maxLength' characters in length.");
        }

        $pattern = SmsConstants::FOREIGN_ID_PATTERN;
        if (strlen($foreignId) !== preg_match_all($pattern, $foreignId)) {
            throw new InvalidOptionalArgumentException(
                "foreign_id must match the regex pattern $pattern");
        }
    }

    public function from(): void {
    }

    /** @throws InvalidOptionalArgumentException */
    public function label(): void {
        $label = $this->params->getLabel();

        if (null === $label || '' === $label) {
            return;
        }

        $max = SmsConstants::LABEL_MAX_LENGTH;
        if (mb_strlen($label) > $max) {
            throw new InvalidOptionalArgumentException(
                "label must not exceed '$max' characters in length.");
        }

        $pattern = SmsConstants::LABEL_PATTERN;
        if (strlen($label) !== preg_match_all($pattern, $label)) {
            throw new InvalidOptionalArgumentException(
                "label must match the regex pattern $pattern");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function content(): void {
        $hasText = '' !== trim($this->params->getText() ?? '');
        $hasCarousel = null !== $this->params->getCarousel();
        $hasRichcard = null !== $this->params->getRichcard();
        $hasFile = null !== $this->params->getFile();

        $setContentTypes = 0;
        foreach ([$hasText, $hasCarousel, $hasRichcard, $hasFile] as $set) {
            if ($set) {
                ++$setContentTypes;
            }
        }

        if (0 === $setContentTypes) {
            throw new InvalidRequiredArgumentException(
                'You must provide one content type: text, carousel, richcard or file.');
        }

        if ($setContentTypes > 1) {
            throw new InvalidRequiredArgumentException(
                'Only one content type is allowed: text, carousel, richcard or file.');
        }

        if ($hasCarousel) {
            $carousel = $this->params->getCarousel();
            foreach ($carousel->getRichcards() as $richcard) {
                $this->validateRichcardSuggestions($richcard);
            }
        }

        if ($hasRichcard) {
            $this->validateRichcardSuggestions($this->params->getRichcard());
        }

        if ($hasFile) {
            $this->validateFile($this->params->getFile());
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        $to = $this->params->getTo();

        if ('' === $to) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }

    /** @throws InvalidOptionalArgumentException */
    public function ttl(): void {
        $ttl = $this->params->getTtl();

        if (null === $ttl) {
            return;
        }

        if (0 === $ttl) {
            $this->params->setTtl(null);
            return;
        }

        $min = SmsConstants::TTL_MIN;
        $max = SmsConstants::TTL_MAX;

        if ($ttl < $min) {
            throw new InvalidOptionalArgumentException(
                "ttl must be at least $min.");
        }

        if ($ttl > $max) {
            throw new InvalidOptionalArgumentException(
                "ttl may not exceed $max.");
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function suggestions(): void {
        $suggestions = $this->params->getSuggestions();

        if (null === $suggestions) {
            return;
        }

        if (count($suggestions) > self::MAX_ROOT_SUGGESTIONS) {
            throw new InvalidRequiredArgumentException(
                'RCS messages support at most 11 root-level suggestions.');
        }

        foreach ($suggestions as $suggestion) {
            $this->validateSuggestion($suggestion);
        }
    }

    /** @throws InvalidRequiredArgumentException */
    private function validateRichcardSuggestions(?RcsRichcardParams $richcard): void {
        if (null === $richcard) {
            return;
        }

        $suggestions = $richcard->getSuggestions();
        if (null === $suggestions) {
            return;
        }

        if (count($suggestions) > self::MAX_RICHCARD_SUGGESTIONS) {
            throw new InvalidRequiredArgumentException(
                'A richcard supports at most 4 suggestions.');
        }

        foreach ($suggestions as $suggestion) {
            $this->validateSuggestion($suggestion);
        }
    }

    /** @throws InvalidRequiredArgumentException */
    private function validateSuggestion(RcsSuggestionParams $suggestion): void {
        $type = $suggestion->getType();

        if (RcsSuggestionType::DIAL === $type && '' === trim((string)$suggestion->getPhoneNumber())) {
            throw new InvalidRequiredArgumentException('A dial suggestion requires phoneNumber.');
        }

        if (RcsSuggestionType::VIEW_LOCATION === $type && null === $suggestion->getLocation()) {
            throw new InvalidRequiredArgumentException('A viewLocation suggestion requires location.');
        }

        if (RcsSuggestionType::CREATE_CALENDAR_EVENT === $type && null === $suggestion->getCalendarEvent()) {
            throw new InvalidRequiredArgumentException('A createCalendarEvent suggestion requires calendarEvent.');
        }

        if (RcsSuggestionType::OPEN_URL === $type && '' === trim((string)$suggestion->getUrl())) {
            throw new InvalidRequiredArgumentException('An openUrl suggestion requires url.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    private function validateFile(?RcsFileParams $file): void {
        if (null === $file) {
            return;
        }

        $hasFileUrl = '' !== trim((string)$file->getFileUrl());
        $hasFileContents = '' !== trim((string)$file->getFileContents());

        if (!$hasFileUrl && !$hasFileContents) {
            throw new InvalidRequiredArgumentException(
                'A file content requires either fileUrl or fileContents.');
        }
    }
}
