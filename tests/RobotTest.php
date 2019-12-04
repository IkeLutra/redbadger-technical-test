<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Robot;
use IkeLutra\RedBadger\CoordinateInterface;

class RobotTest extends TestCase
{
    public function testConstruct()
    {
        $robot = new Robot([4, 5]);
        $this->assertInstanceOf(Robot::class, $robot);
        $this->assertInstanceOf(CoordinateInterface::class, $robot);
        $this->assertSame([4, 5], $robot->getCoordinates());
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
}
