<?php

namespace IkeLutra\RedBadger\Instruction;

use IkeLutra\RedBadger\DirectionInterface;

abstract class ChangeDirection
{
    protected $directionModifier = 0;

    /**
     * Changes direction using directionModifier
     * and ensures it still lies between 0 and 3 inclusive
     *
     * @param integer $direction
     * @return integer
     */
    private function normalize(int $direction): int
    {
        if ($direction < 0) {
            return $this->normalize(4 + $direction);
        } elseif ($direction > 3) {
            return $this->normalize($direction - 4);
        }
        return $direction;
    }

    /**
     * Sets new direction on unit
     *
     * @param DirectionInterface $unit
     * @return DirectionInterface
     */
    public function __invoke(DirectionInterface $unit): DirectionInterface
    {
        $direction = $unit->getDirection();
        $newDirection = $this->normalize($direction + $this->directionModifier);
        $unit->setDirection($newDirection);
        return $unit;
    }
}
