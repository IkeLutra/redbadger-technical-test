<?php

namespace Tests\IkeLutra\RedBadger;

use IkeLutra\RedBadger\DirectionInterface;
use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Instruction\Left;

class LeftTest extends TestCase
{
    protected function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet();
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }

    public function testConstruct()
    {
        $instruction = new Left();
        $this->assertInstanceOf(Left::class, $instruction);
        $this->assertIsCallable($instruction);
    }

    public function testInvoke()
    {
        $instruction = new Left();
        $oldDirection = $this->prophet->prophesize(DirectionInterface::class);
        $oldDirection->getDirection()->willReturn(1);
        $oldDirection->setDirection(0)->shouldBeCalledTimes(1);
        $mock = $oldDirection->reveal();
        $newDirection = $instruction($mock);
        $this->assertSame($mock, $newDirection);
    }

    public function testInvokeNorthToWest()
    {
        $instruction = new Left();
        $oldDirection = $this->prophet->prophesize(DirectionInterface::class);
        $oldDirection->getDirection()->willReturn(0);
        $oldDirection->setDirection(3)->shouldBeCalledTimes(1);
        $mock = $oldDirection->reveal();
        $newDirection = $instruction($mock);
        $this->assertSame($mock, $newDirection);
    }
}
