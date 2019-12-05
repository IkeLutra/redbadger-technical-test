<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Map;

class MapTest extends TestCase
{

    public function testConstruct()
    {
        $map = new Map([1, 1]);
        $this->assertInstanceOf(Map::class, $map);
    }

    public function testIsOutOfBounds()
    {
        $map = new Map([5, 3]);
        $this->assertFalse($map->isOutOfBounds([0, 0]));
        $this->assertFalse($map->isOutOfBounds([5, 3]));
        $this->assertFalse($map->isOutOfBounds([2, 2]));
        $this->assertTrue($map->isOutOfBounds([6, 3]));
        $this->assertTrue($map->isOutOfBounds([5, 4]));
        $this->assertTrue($map->isOutOfBounds([-1, 0]));
        $this->assertTrue($map->isOutOfBounds([0, -1]));
        $this->assertTrue($map->isOutOfBounds([10, 10]));
        $this->assertTrue($map->isOutOfBounds([-10, -10]));
    }

    public function testScents()
    {
        $map = new Map([5, 3]);
        $this->assertFalse($map->doesThisSmell([5, 3]));
        $map->addScent([5, 3]);
        $this->assertTrue($map->doesThisSmell([5, 3]));
    }
}
