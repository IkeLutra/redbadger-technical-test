<?php

namespace Tests\IkeLutra\RedBadger;

use IkeLutra\RedBadger\InputParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use IkeLutra\RedBadger\MoveRobotsCommand;
use IkeLutra\RedBadger\OutputFormatter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class MoveRobotsCommandTest extends TestCase
{
    public function testConstruct()
    {
        $command = new MoveRobotsCommand(new InputParser(), new OutputFormatter());
        $this->assertInstanceOf(Command::class, $command);
    }

    public function testExecute()
    {
        $app = new Application();
        $command = new MoveRobotsCommand(new InputParser(), new OutputFormatter());
        $app->add($command);
        $commandTester = new CommandTester($app->find('move:robots'));
        $commandTester->execute([
            'input-file' => __DIR__ . '/../example_input.txt'
        ]);
        $output = $commandTester->getDisplay();
        $expectedOutput = <<<OUTPUT
        1 1 E
        3 3 N LOST
        2 3 S
        OUTPUT;
        $this->assertStringContainsString($expectedOutput, $output);
    }
}
