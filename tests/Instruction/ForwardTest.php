<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Instruction\Forward;
use IkeLutra\RedBadger\Robot;

class ForwardTest extends TestCase
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
        $instruction = new Forward();
        $this->assertInstanceOf(Forward::class, $instruction);
        $this->assertIsCallable($instruction);
    }

    public function testInvokeNorth()
    {
        $instruction = new Forward();
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([0, 0]);
        $robot->getDirection()->willReturn(0);
        $robot->setCoordinates([0, 1])->shouldBeCalledTimes(1);
        $robotMock = $robot->reveal();
        $response = $instruction($robotMock);
        $this->assertSame($robotMock, $response);
    }

    public function testInvokeSouth()
    {
        $instruction = new Forward();
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([1, 1]);
        $robot->getDirection()->willReturn(2);
        $robot->setCoordinates([1, 0])->shouldBeCalledTimes(1);
        $robotMock = $robot->reveal();
        $response = $instruction($robotMock);
        $this->assertSame($robotMock, $response);
    }

    public function testInvokeEast()
    {
        $instruction = new Forward();
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([1, 1]);
        $robot->getDirection()->willReturn(1);
        $robot->setCoordinates([2, 1])->shouldBeCalledTimes(1);
        $robotMock = $robot->reveal();
        $response = $instruction($robotMock);
        $this->assertSame($robotMock, $response);
    }

    public function testInvokeWest()
    {
        $instruction = new Forward();
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([1, 1]);
        $robot->getDirection()->willReturn(3);
        $robot->setCoordinates([0, 1])->shouldBeCalledTimes(1);
        $robotMock = $robot->reveal();
        $response = $instruction($robotMock);
        $this->assertSame($robotMock, $response);
    }
}
