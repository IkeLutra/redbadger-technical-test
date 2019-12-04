<?php

namespace IkeLutra\RedBadger\Instruction;

use IkeLutra\RedBadger\DirectionInterface;

class Right
{
    private function normalize(int $direction): int
    {
        if ($direction < 0) {
            return $this->normalize(4 + $direction);
        } elseif ($direction > 3) {
            return $this->normalize($direction - 4);
        }
        return $direction;
    }

    public function __invoke(DirectionInterface $unit): DirectionInterface
    {
        $direction = $unit->getDirection();
        $newDirection = $this->normalize($direction + 1);
        $unit->setDirection($newDirection);
        return $unit;
    }
}