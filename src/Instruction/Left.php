<?php

namespace IkeLutra\RedBadger\Instruction;

use IkeLutra\RedBadger\DirectionInterface;

class Left
{
    private function normalize(int $direction): int
    {
        if ($direction < 0) {
            return 4 + $direction;
        }
        return $direction;
    }

    public function __invoke(DirectionInterface $unit): DirectionInterface
    {
        $direction = $unit->getDirection();
        $newDirection = $this->normalize($direction - 1);
        $unit->setDirection($newDirection);
        return $unit;
    }
}