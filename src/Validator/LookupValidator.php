<?php declare(strict_types=1);

namespace Sms77\Api\Validator;

use Sms77\Api\Exception\InvalidOptionalArgumentException;
use Sms77\Api\Exception\InvalidRequiredArgumentException;

class LookupValidator extends BaseValidator implements ValidatorInterface {
    public const TYPE_CNAM = 'cnam';
    public const TYPE_FORMAT = 'format';
    public const TYPE_HLR = 'hlr';
    public const TYPE_MNP = 'mnp';
    public const TYPES = [
        self::TYPE_CNAM, self::TYPE_FORMAT, self::TYPE_HLR, self::TYPE_MNP,
    ];

    public static function isValidMobileNetworkShortName(string $subject): bool {
        return 1 === preg_match('/d1|d2|o2|eplus|N\/A|int/', $subject);
    }

    /**
     * @throws InvalidOptionalArgumentException
     * @throws InvalidRequiredArgumentException
     */
    public function validate(): void {
        $this->json();
        $this->number();
        $this->type();
    }

    /**
     * @throws InvalidOptionalArgumentException
     */
    public function json(): void {
        $json = $this->fallback('json');

        if (null !== $json) {
            $type = $this->fallback('type');

            if (self::TYPE_MNP !== $type) {
                throw new InvalidOptionalArgumentException('json may only be set if type is set to mnp.');
            }

            if (!$this->isValidBool($json)) {
                throw new InvalidOptionalArgumentException('json can be either 1 or 0.');
            }
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function number(): void {
        $number = $this->fallback('number', '');

        if ('' === $number) {
            throw new InvalidRequiredArgumentException('number is missing.');
        }
    }

    /**
     * @throws InvalidRequiredArgumentException
     */
    public function type(): void {
        $type = $this->fallback('type');

        if (!in_array($type, self::TYPES, true)) {
            $imploded = implode(',', self::TYPES);

            throw new InvalidRequiredArgumentException(
                "type $type is invalid. Valid types are: $imploded.");
        }
    }
}