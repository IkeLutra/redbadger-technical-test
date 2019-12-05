<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Robot;
use IkeLutra\RedBadger\CoordinateInterface;
use IkeLutra\RedBadger\DirectionInterface;

class RobotTest extends TestCase
{
    public function testConstruct()
    {
        $robot = new Robot([4, 5], 1);
        $this->assertInstanceOf(Robot::class, $robot);
        $this->assertInstanceOf(CoordinateInterface::class, $robot);
        $this->assertInstanceOf(DirectionInterface::class, $robot);
        $this->assertSame([4, 5], $robot->getCoordinates());
        $this->assertSame(1, $robot->getDirection());
    }

    public function testGetCoordinates()
    {
        $robot = new Robot();
        $this->assertSame([0, 0], $robot->getCoordinates());
    }

    public function testSetCoordinates()
    {
        $robot = new Robot();
        $robot->setCoordinates([2,3]);
        $this->assertSame([2, 3], $robot->getCoordinates());
    }

    public function testGetDirection()
    {
        $robot = new Robot();
        $this->assertSame(0, $robot->getDirection());
    }

    public function testSetDirection()
    {
        $robot = new Robot();
        $robot->setDirection(2);
        $this->assertSame(2, $robot->getDirection());
    }

    public function testLost()
    {
        $robot = new Robot();
        $this->assertFalse($robot->isLost());
        $robot->markAsLost();
        $this->assertTrue($robot->isLost());
    }
}
