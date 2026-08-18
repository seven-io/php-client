<?php declare(strict_types=1);

namespace Seven\Tests;

use PHPUnit\Framework\TestCase;
use Seven\Api\Exception\InvalidRequiredArgumentException;
use Seven\Api\Resource\Rcs\RcsFallbackParams;
use Seven\Api\Resource\Rcs\RcsFallbackType;
use Seven\Api\Resource\Rcs\RcsCarouselParams;
use Seven\Api\Resource\Rcs\RcsCarouselWidth;
use Seven\Api\Resource\Rcs\RcsFileHeight;
use Seven\Api\Resource\Rcs\RcsFileParams;
use Seven\Api\Resource\Rcs\RcsParams;
use Seven\Api\Resource\Rcs\RcsRichcardParams;
use Seven\Api\Resource\Rcs\RcsSuggestionParams;
use Seven\Api\Resource\Rcs\RcsSuggestionType;
use Seven\Api\Resource\Rcs\RcsValidator;
use Seven\Api\Resource\Rcs\RcsWebviewMode;

final class RcsParamsTest extends TestCase
{
    public function testToArraySupportsCarouselContent(): void
    {
        $card = (new RcsRichcardParams('Dog', 'Picture of a dog'))
            ->setFile(
                (new RcsFileParams)
                    ->setHeight(RcsFileHeight::TALL)
                    ->setFileUrl('https://example.com/dog.jpg')
                    ->setThumbnailUrl('https://example.com/dog-thumb.jpg')
            )
            ->setSuggestions(
                new RcsSuggestionParams(RcsSuggestionType::REPLY, 'Cute', 'dog_cute')
            );

        $params = RcsParams::carousel(
            new RcsCarouselParams(RcsCarouselWidth::SMALL, $card),
            '491716992343'
        );

        $payload = $params->toArray();

        $this->assertArrayHasKey('carousel', $payload);
        $this->assertArrayNotHasKey('text', $payload);
        $this->assertSame('SMALL', $payload['carousel']['width']);
        $this->assertCount(1, $payload['carousel']['richcards']);
        $this->assertSame('Dog', $payload['carousel']['richcards'][0]['title']);
    }

    public function testToArraySupportsSuggestionsForTextMessage(): void
    {
        $params = (new RcsParams('Visit our website', '491716992343'))
            ->setSuggestions(
                (new RcsSuggestionParams(RcsSuggestionType::OPEN_URL, 'Open', 'open_site'))
                    ->setUrl('https://example.com')
                    ->setWebviewMode(RcsWebviewMode::FULL)
            );

        $payload = $params->toArray();

        $this->assertSame('Visit our website', $payload['text']);
        $this->assertArrayHasKey('suggestions', $payload);
        $this->assertSame('openUrl', $payload['suggestions'][0]['type']);
        $this->assertSame('https://example.com', $payload['suggestions'][0]['url']);
        $this->assertSame('full', $payload['suggestions'][0]['webviewMode']);
    }

    public function testValidateFailsWhenNoContentTypeIsProvided(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        (new RcsValidator(new RcsParams('', '491716992343')))->validate();
    }

    public function testValidateFailsWhenMultipleContentTypesAreProvided(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = (new RcsParams('Text content', '491716992343'))
            ->setFile((new RcsFileParams)->setFileUrl('https://example.com/file.pdf'));

        (new RcsValidator($params))->validate();
    }

    public function testValidateFailsWhenTooManyRootSuggestionsAreProvided(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = new RcsParams('Text content', '491716992343');

        $suggestions = [];
        for ($i = 0; $i < 12; ++$i) {
            $suggestions[] = new RcsSuggestionParams(
                RcsSuggestionType::REPLY,
                'Answer ' . $i,
                'answer_' . $i
            );
        }

        $params->setSuggestions(...$suggestions);

        (new RcsValidator($params))->validate();
    }

    public function testValidateFailsWhenOpenUrlSuggestionHasNoUrl(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = (new RcsParams('Text content', '491716992343'))
            ->setSuggestions(
                new RcsSuggestionParams(RcsSuggestionType::OPEN_URL, 'Open', 'open_site')
            );

        (new RcsValidator($params))->validate();
    }

    public function testToArraySupportsStructuredFallbackWithSender(): void
    {
        $params = (new RcsParams('RCS content', '491716992343'))
            ->setFallback(
                (new RcsFallbackParams(RcsFallbackType::SMS))
                    ->setText('SMS fallback text')
                    ->setFrom('MyBrand')
            );

        $payload = $params->toArray();

        $this->assertSame('sms', $payload['fallback']['type']);
        $this->assertSame('SMS fallback text', $payload['fallback']['text']);
        $this->assertSame('MyBrand', $payload['fallback']['from']);
    }

    public function testValidateFailsWhenSmsFallbackObjectHasNoText(): void
    {
        $this->expectException(InvalidRequiredArgumentException::class);

        $params = (new RcsParams('RCS content', '491716992343'))
            ->setFallback(
                (new RcsFallbackParams(RcsFallbackType::SMS))
                    ->setFrom('MyBrand')
            );

        (new RcsValidator($params))->validate();
    }
}
