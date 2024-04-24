<?php declare(strict_types=1);

namespace Seven\Api\Validator;

use Seven\Api\Exception\InvalidOptionalArgumentException;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Params\VoiceParams;

class VoiceValidator
{

    protected VoiceParams $params;

    public function __construct(VoiceParams $params)
    {
        $this->params = $params;
    }

    /**
     * @throws InvalidRequiredArgumentException|InvalidOptionalArgumentException
     */
    public function validate(): void
    {
        $this->from();
        $this->ringtime();
        $this->text();
        $this->to();
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function from(): void
    {
        $from = $this->params->getFrom();

        if ($from === null) return;

        if ('' === $from) {
            $this->params->setFrom(null);
            return;
        }

        $max = 16;

        if (strlen($from) > $max) throw new InvalidOptionalArgumentException(
            "From may not exceed $max characters"
        );
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function ringtime(): void
    {
        $ringtime = $this->params->getRingtime();

        if ($ringtime === null) return;

        $min = 1;
        $max = 60;

        if ($ringtime < $min) throw new InvalidOptionalArgumentException(
            'Ringtime may not be lower than: ' . $min
        );

        if ($ringtime > $max) throw new InvalidOptionalArgumentException(
            'Ringtime may not be higher than: ' . $max
        );
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void
    {
        $text = $this->params->getText();

        $max = 10000;

        if ('' === $text)
            throw new InvalidRequiredArgumentException('You cannot send an empty message.');

        if (strlen($text) > $max)
            throw new InvalidRequiredArgumentException("Text may not exceed $max characters");
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void
    {
        $to = $this->params->getTo();

        if ('' === $to) throw new InvalidRequiredArgumentException(
            'You cannot send a message without specifying a recipient.'
        );
    }
}
