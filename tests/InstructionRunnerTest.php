<?php

namespace Tests\IkeLutra\RedBadger;

use PHPUnit\Framework\TestCase;
use IkeLutra\RedBadger\Instruction\Forward;
use IkeLutra\RedBadger\Instruction\Left;
use IkeLutra\RedBadger\Instruction\Right;
use IkeLutra\RedBadger\Robot;
use IkeLutra\RedBadger\InstructionRunner;

class InstructionRunnerTest extends TestCase
{
    public function setUp(): void
    {
        $this->instructions = [
            'L' => new Left(),
            'R' => new Right(),
            'F' => new Forward()
        ];
    }

    public function testConstruct()
    {
        $runner = new InstructionRunner($this->instructions);
        $this->assertInstanceOf(InstructionRunner::class, $runner);
    }

    public function testRun()
    {
        $robot = new Robot([1, 1], 1);
        $runner = new InstructionRunner($this->instructions);
        $instructions = ['R', 'F', 'R', 'F', 'R', 'F'];
        $robot = $runner->run($robot, $instructions);
        $this->assertSame([0, 1], $robot->getCoordinates());
        $this->assertSame(0, $robot->getDirection());
    }
}
