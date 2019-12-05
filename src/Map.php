<?php

namespace IkeLutra\RedBadger;

class Map
{
    private $minX = 0;
    private $minY = 0;
    private $maxX;
    private $maxY;

    private $scents = [];

    public function __construct(array $maxCoordinates)
    {
        $this->maxX = $maxCoordinates[0];
        $this->maxY = $maxCoordinates[1];
    }

    public function isOutOfBounds(array $coordinates): bool
    {
        $x = $coordinates[0];
        $y = $coordinates[1];
        if ($x > $this->maxX ||
            $x < $this->minX ||
            $y > $this->maxY ||
            $y < $this->minY
        ) {
            return true;
        }
        return false;
    }

    public function addScent(array $coordinates): void
    {
        $this->scents[] = $coordinates;
    }

    public function doesThisSmell(array $coordinates): bool
    {
        foreach ($this->scents as $scent) {
            if ($scent[0] === $coordinates[0] && $scent[1] === $coordinates[1]) {
                return true;
            }
        }
        return false;
    }
}
