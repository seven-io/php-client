<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidBooleanOptionException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;
use Sms77\Api\Params\VoiceParamsInterface;

class VoiceValidator extends BaseValidator implements ValidatorInterface {
    /* @var VoiceParamsInterface $params */
    protected $params;

    public function __construct(VoiceParamsInterface $params) {
        $this->params = $params;

        parent::__construct((array)$this->params, ['xml']);
    }

    /**
     * @throws InvalidRequiredArgumentException
     * @throws InvalidBooleanOptionException
     */
    public function validate(): void {
        $this->from();
        $this->text();
        $this->to();

        parent::validate();
    }

    public function from(): void {
        if ('' === $this->params->getFrom()) {
            $this->params->setFrom(null);
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function text(): void {
        $text = $this->params->getText() ?? '';

        if (null === $text || '' === $text) {
            throw new InvalidRequiredArgumentException(
                'You cannot send an empty message.');
        }
    }

    /** @throws InvalidRequiredArgumentException */
    public function to(): void {
        $to = $this->params->getTo() ?? '';

        if (null === $to || '' === $to) {
            throw new InvalidRequiredArgumentException(
                'You cannot send a message without specifying a recipient.');
        }
    }
}