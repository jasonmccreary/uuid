<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Nonstandard;

use JMac\Testing\Double;
use Mockery;
use Ramsey\Uuid\Codec\CodecInterface;
use Ramsey\Uuid\Exception\UnableToBuildUuidException;
use Ramsey\Uuid\Nonstandard\UuidBuilder;
use Ramsey\Uuid\Test\TestCase;
use RuntimeException;

class UuidBuilderTest extends TestCase
{
    public function testBuildThrowsException(): void
    {
        $codec = Double::for(CodecInterface::class);

        $builder = Double::for(UuidBuilder::class)->passthru();
        $builder->shouldReceive('buildFields')->andThrow(
            RuntimeException::class,
            'exception thrown'
        );

        $this->expectException(UnableToBuildUuidException::class);
        $this->expectExceptionMessage('exception thrown');

        $builder->build($codec, 'foobar');
    }
}
