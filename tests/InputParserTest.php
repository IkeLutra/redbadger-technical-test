<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\InputParser;
use IkeLutra\RedBadger\Map;
use IkeLutra\RedBadger\Robot;

class InputParserTest extends TestCase
{
    public function testConstruct()
    {
        $parser = new InputParser();
        $this->assertInstanceOf(InputParser::class, $parser);
    }

    public function testParse()
    {
        $parser = new InputParser();
        $input = <<<INPUT
        5 3
        1 1 E
        RFRFRFRF

        3 2 N
        FRRFLLFFRRFLL

        0 3 W
        LLFFFLFLFL
        INPUT;
        $objects = $parser->parse($input);
        $this->assertArrayHasKey('map', $objects);
        $this->assertInstanceOf(Map::class, $objects['map']);
        $this->assertSame([5, 3], $objects['map']->getMaxCoordinates());
        $this->assertArrayHasKey('entries', $objects);
        $this->assertIsArray($objects['entries']);
        $this->assertSame(3, count($objects['entries']));
        // Entry 1
        $entry1 = $objects['entries'][0];
        $this->assertArrayHasKey('robot', $entry1);
        $this->assertInstanceOf(Robot::class, $entry1['robot']);
        $this->assertSame([1, 1], $entry1['robot']->getCoordinates());
        $this->assertSame(1, $entry1['robot']->getDirection());
        $this->assertArrayHasKey('instructions', $entry1);
        $this->assertSame(['R', 'F', 'R', 'F', 'R', 'F', 'R', 'F'], $entry1['instructions']);
        // Entry 2
        $entry2 = $objects['entries'][1];
        $this->assertArrayHasKey('robot', $entry2);
        $this->assertInstanceOf(Robot::class, $entry2['robot']);
        $this->assertSame([3, 2], $entry2['robot']->getCoordinates());
        $this->assertSame(0, $entry2['robot']->getDirection());
        $this->assertArrayHasKey('instructions', $entry2);
        $this->assertSame(['F', 'R', 'R', 'F', 'L', 'L', 'F', 'F', 'R', 'R', 'F', 'L', 'L'], $entry2['instructions']);
        // Entry 3
        $entry3 = $objects['entries'][2];
        $this->assertArrayHasKey('robot', $entry3);
        $this->assertInstanceOf(Robot::class, $entry3['robot']);
        $this->assertSame([0, 3], $entry3['robot']->getCoordinates());
        $this->assertSame(3, $entry3['robot']->getDirection());
        $this->assertArrayHasKey('instructions', $entry3);
        $this->assertSame(['L', 'L', 'F', 'F', 'F', 'L', 'F', 'L', 'F', 'L'], $entry3['instructions']);
    }
}