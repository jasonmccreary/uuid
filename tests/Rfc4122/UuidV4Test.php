<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Rfc4122;

use JMac\Testing\Double;
use Mockery;
use Ramsey\Uuid\Codec\CodecInterface;
use Ramsey\Uuid\Converter\NumberConverterInterface;
use Ramsey\Uuid\Converter\TimeConverterInterface;
use Ramsey\Uuid\Exception\InvalidArgumentException;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Test\TestCase;

class UuidV4Test extends TestCase
{
    /**
     * @dataProvider provideTestVersions
     */
    public function testConstructorThrowsExceptionWhenFieldsAreNotValidForType(int $version): void
    {
        $fields = Double::for(FieldsInterface::class);
        $fields->allows('getVersion')->returns($version);

        $numberConverter = Double::for(NumberConverterInterface::class);
        $codec = Double::for(CodecInterface::class);
        $timeConverter = Double::for(TimeConverterInterface::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Fields used to create a UuidV4 must represent a '
            . 'version 4 (random) UUID'
        );

        new UuidV4($fields, $numberConverter, $codec, $timeConverter);
    }

    /**
     * @return array<array{version: int}>
     */
    public function provideTestVersions(): array
    {
        return [
            ['version' => 0],
            ['version' => 1],
            ['version' => 2],
            ['version' => 3],
            ['version' => 5],
            ['version' => 6],
            ['version' => 7],
            ['version' => 8],
            ['version' => 9],
        ];
    }
}
