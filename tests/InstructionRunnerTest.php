<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Instruction\Forward;
use IkeLutra\RedBadger\Instruction\Left;
use IkeLutra\RedBadger\Instruction\Right;
use IkeLutra\RedBadger\Robot;
use IkeLutra\RedBadger\InstructionRunner;
use IkeLutra\RedBadger\Map;

class InstructionRunnerTest extends TestCase
{
    public function setUp(): void
    {
        $this->instructionMap = [
            'L' => new Left(),
            'R' => new Right(),
            'F' => new Forward()
        ];
        $this->map = new Map([5, 3]);
    }

    public function testConstruct()
    {
        $runner = new InstructionRunner($this->instructionMap, $this->map);
        $this->assertInstanceOf(InstructionRunner::class, $runner);
    }

    public function testRun()
    {
        $robot = new Robot([1, 1], 1);
        $runner = new InstructionRunner($this->instructionMap, $this->map);
        $instructions = ['R', 'F', 'R', 'F', 'R', 'F'];
        $robot = $runner->run($robot, $instructions);
        $this->assertSame([0, 1], $robot->getCoordinates());
        $this->assertSame(0, $robot->getDirection());
    }

    public function testRunWithLost()
    {
        $robot1 = new Robot([1, 1], 1);
        $robot2 = new Robot([3, 2], 0);
        $robot3 = new Robot([0, 3], 3);
        $runner = new InstructionRunner($this->instructionMap, $this->map);
        // Robot1
        $instructions1 = ['R', 'F', 'R', 'F', 'R', 'F', 'R', 'F'];
        $robot1 = $runner->run($robot1, $instructions1);
        $this->assertSame([1, 1], $robot1->getCoordinates());
        $this->assertSame(1, $robot1->getDirection());
        $this->assertFalse($robot1->isLost());
        // Robot2
        $instructions2 = ['F', 'R', 'R', 'F', 'L', 'L', 'F', 'F', 'R', 'R', 'F', 'L', 'L'];
        $robot2 = $runner->run($robot2, $instructions2);
        $this->assertSame([3, 3], $robot2->getCoordinates());
        $this->assertSame(0, $robot2->getDirection());
        $this->assertTrue($robot2->isLost());
        // Robot3
        $instructions3 = ['L', 'L', 'F', 'F', 'F', 'L', 'F', 'L', 'F', 'L'];
        $robot3 = $runner->run($robot3, $instructions3);
        $this->assertSame([2, 3], $robot3->getCoordinates());
        $this->assertSame(2, $robot3->getDirection());
        $this->assertFalse($robot3->isLost());
    }
}
