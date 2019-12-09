<?php

namespace IkeLutra\RedBadger;

use IkeLutra\RedBadger\Instruction\Forward;
use IkeLutra\RedBadger\Instruction\Left;
use IkeLutra\RedBadger\Instruction\Right;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MoveRobotsCommand extends Command
{
    protected static $defaultName = 'move:robots';

    /**
     * @var InputParser
     */
    private $inputParser;
    /**
     * @var OutputFormatter
     */
    private $outputFormatter;

    /**
     * @var callable[]
     */
    private $instructionMap;

    public function __construct(InputParser $inputParser, OutputFormatter $outputFormatter)
    {
        parent::__construct();
        $this->inputParser = $inputParser;
        $this->outputFormatter = $outputFormatter;
        $this->instructionMap =  [
            'L' => new Left(),
            'R' => new Right(),
            'F' => new Forward()
        ];
    }

    protected function configure()
    {
        $this->addArgument('input-file', InputArgument::REQUIRED, 'Path to file containing map and robot commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputContent = file_get_contents($input->getArgument('input-file'));
        $parsed = $this->inputParser->parse($inputContent);
        $runner = new InstructionRunner($this->instructionMap, $parsed['map']);
        foreach ($parsed['entries'] as $entry) {
            $robot = $runner->run($entry['robot'], $entry['instructions']);
            $output->writeln($this->outputFormatter->format($robot));
        }
        return 0;
    }
}