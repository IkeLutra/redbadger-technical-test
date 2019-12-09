<?php

namespace IkeLutra\RedBadger;

class Map
{
    /**
     * Minimum X coordinate
     *
     * @var integer
     */
    private $minX = 0;
    /**
     * Minimum Y coordinate
     *
     * @var integer
     */
    private $minY = 0;
    /**
     * Maximum X coordinate
     *
     * @var integer
     */
    private $maxX;
    /**
     * Maximum Y cooridinate
     *
     * @var integer
     */
    private $maxY;

    private $scents = [];

    /**
     * Takes an array of coordinates that defines the max X and Y coordinates
     *
     * @throws MapTooLargeException
     * @param array $maxCoordinates
     */
    public function __construct(array $maxCoordinates)
    {
        $this->maxX = $maxCoordinates[0];
        $this->maxY = $maxCoordinates[1];
        if ($this->maxX > 50) {
            throw new MapTooLargeException("X coordinate {$this->maxX} is larger than 50");
        }
        if ($this->maxY > 50) {
            throw new MapTooLargeException("Y coordinate {$this->maxY} is larger than 50");
        }
    }

    /**
     * Checks if a set of coordinates if out of the map's allowed grid
     *
     * @param array $coordinates
     * @return boolean
     */
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

    /**
     * Adds a marker to the map to note where previouse robots were lost
     *
     * @param array $coordinates
     * @return void
     */
    public function addScent(array $coordinates): void
    {
        $this->scents[] = $coordinates;
    }

    /**
     * Checks if the coordinates match any exisiting scents
     *
     * @param array $coordinates
     * @return boolean
     */
    public function doesThisSmell(array $coordinates): bool
    {
        foreach ($this->scents as $scent) {
            if ($scent[0] === $coordinates[0] && $scent[1] === $coordinates[1]) {
                return true;
            }
        }
        return false;
    }

    /**
     * Gets the maximum X and Y coordinates
     *
     * @return array
     */
    public function getMaxCoordinates(): array
    {
        return [$this->maxX, $this->maxY];
    }
}
