<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\OutputFormatter;
use IkeLutra\RedBadger\Robot;

class OutputFormatterTest extends TestCase
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
        $formatter = new OutputFormatter();
        $this->assertInstanceOf(OutputFormatter::class, $formatter);
    }

    public function testFormat()
    {
        $formatter = new OutputFormatter();
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([1, 1]);
        $robot->getDirection()->willReturn(1);
        $robot->isLost()->willReturn(false);
        $output = $formatter->format($robot->reveal());
        $this->assertSame('1 1 E', $output);
        $robot = $this->prophet->prophesize(Robot::class);
        $robot->getCoordinates()->willReturn([3, 3]);
        $robot->getDirection()->willReturn(0);
        $robot->isLost()->willReturn(true);
        $output = $formatter->format($robot->reveal());
        $this->assertSame('3 3 N LOST', $output);
    }
}
