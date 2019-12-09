<?php

namespace IkeLutra\RedBadger;

class InstructionRunner
{
    private $instructionMap;
    private $map;

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
