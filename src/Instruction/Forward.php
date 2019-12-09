<?php

namespace IkeLutra\RedBadger\Instruction;

use IkeLutra\RedBadger\Robot;

class Forward
{
    /**
     * TODO: Don't rely on Robot use interface instead
     *
     * Moves the robot 1 space forward (dependent on the direction)
     */
    public function __invoke(Robot $robot)
    {
        $coordinates = $robot->getCoordinates();
        $changeIndex = ($robot->getDirection() % 2) === 0 ? 1 : 0;
        $modifier = 1;
        if ($robot->getDirection() > 1) {
            $modifier = -1;
        }
        $coordinates[$changeIndex] = $coordinates[$changeIndex] + $modifier;
        $robot->setCoordinates($coordinates);
        return $robot;
    }
}
