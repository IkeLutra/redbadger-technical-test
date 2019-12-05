<?php

namespace IkeLutra\RedBadger;

class InstructionRunner
{
    private $instructionMap;
    private $map;

    public function __construct(array $instructionMap, Map $map)
    {
        // TODO: Validate instructionMap only contains callables
        $this->instructionMap = $instructionMap;
        $this->map = $map;
    }

    public function run(Robot $robot, array $instructions): Robot
    {
        foreach ($instructions as $letter) {
            $oldCoordinates = $robot->getCoordinates();
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
