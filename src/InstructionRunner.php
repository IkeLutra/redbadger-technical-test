<?php

namespace IkeLutra\RedBadger;

class InstructionRunner
{
    /**
     * Map of letters to instruction callables
     *
     * @var callable[]
     */
    private $instructionMap;
    /**
     * @var Map
     */
    private $map;

    /**
     * Pass in an associative array mapping the instruction letter
     * to the callable that implements that instruction
     *
     * @throws Exception
     * @param array $instructionMap
     * @param Map $map
     */
    public function __construct(array $instructionMap, Map $map)
    {
        foreach ($instructionMap as $letter => $instruction) {
            if (!is_callable($instruction)) {
                throw new \Exception("Instruction [$letter] is not callable");
            }
        }
        $this->instructionMap = $instructionMap;
        $this->map = $map;
    }

    /**
     * Runs a set of instructions against a robot
     * Handles robot's getting lost and having awareness of the map
     *
     * @param Robot $robot
     * @param array $instructions
     * @return Robot
     */
    public function run(Robot $robot, array $instructions): Robot
    {
        foreach ($instructions as $letter) {
            $oldCoordinates = $robot->getCoordinates();
            if (!isset($this->instructionMap[$letter])) {
                throw new \Exception("Instruction [$letter] not yet implemented");
            }
            $this->instructionMap[$letter]($robot);
            if ($this->map->isOutOfBounds($robot->getCoordinates())) {
                $robot->setCoordinates($oldCoordinates);
                if (!$this->map->doesThisSmell($oldCoordinates)) {
                    $robot->markAsLost();
                    $this->map->addScent($oldCoordinates);
                    break;
                }
            }
        }
        return $robot;
    }
}
