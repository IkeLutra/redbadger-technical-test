<?php

namespace Tests\IkeLutra\RedBadger;

use IkeLutra\RedBadger\DirectionInterface;
use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Instruction\Right;

class RightTest extends TestCase
{
    protected function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }

    public function testConstruct()
    {
        $instruction = new Right();
        $this->assertInstanceOf(Right::class, $instruction);
        $this->assertIsCallable($instruction);
    }

    public function testInvoke()
    {
        $instruction = new Right();
        $oldDirection = $this->prophet->prophesize(DirectionInterface::class);
        $oldDirection->getDirection()->willReturn(1);
        $oldDirection->setDirection(2)->shouldBeCalledTimes(1);
        $mock = $oldDirection->reveal();
        $newDirection = $instruction($mock);
        $this->assertSame($mock, $newDirection);
    }

    public function testInvokeWestToNorth()
    {
        $instruction = new Right();
        $oldDirection = $this->prophet->prophesize(DirectionInterface::class);
        $oldDirection->getDirection()->willReturn(3);
        $oldDirection->setDirection(0)->shouldBeCalledTimes(1);
        $mock = $oldDirection->reveal();
        $newDirection = $instruction($mock);
        $this->assertSame($mock, $newDirection);
    }
}
