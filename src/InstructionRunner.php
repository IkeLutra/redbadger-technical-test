<?php

namespace IkeLutra\RedBadger;

class InstructionRunner
{
    private $instructionMap;

    public function __construct(array $instructionMap)
    {
        // TODO: Validate instructionMap only contains callables
        $this->instructionMap = $instructionMap;
    }

    public function run(Robot $robot, array $instructions): Robot
    {
        foreach ($instructions as $letter) {
            $this->instructionMap[$letter]($robot);
        }
        return $robot;
    }
}
