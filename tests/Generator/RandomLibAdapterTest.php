<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Generator;

use JMac\Testing\Double;
use Ramsey\Uuid\Generator\RandomLibAdapter;
use Ramsey\Uuid\Test\TestCase;
use RandomLib\Generator;

use function strlen;

class RandomLibAdapterTest extends TestCase
{
    public function testAdapterWithGeneratorUsesGenerator(): void
    {
        $generator = Double::for(Generator::class);
        $generator->expects('generate')->with(4)->returns('abcd');

        $adapter = new RandomLibAdapter($generator);

        $this->assertSame('abcd', $adapter->generate(4));
    }

    public function testAdapterWithoutGeneratorCreatesGenerator(): void
    {
        $adapter = new RandomLibAdapter();

        $this->assertSame(8, strlen($adapter->generate(8)));
    }

    public function testGenerateUsesGenerator(): void
    {
        $length = 10;
        $generator = $this->getMockBuilder(Generator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $generator->expects($this->once())
            ->method('generate')
            ->with($length)
            ->willReturn('foo');

        $adapter = new RandomLibAdapter($generator);
        $adapter->generate($length);
    }

    public function testGenerateReturnsString(): void
    {
        $generator = $this->getMockBuilder(Generator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $generator->expects($this->once())
            ->method('generate')
            ->willReturn('random-string');

        $adapter = new RandomLibAdapter($generator);
        $result = $adapter->generate(1);
        $this->assertSame('random-string', $result);
    }
}
