<?php

namespace IkeLutra\RedBadger;

class Robot implements CoordinateInterface, DirectionInterface
{
    /**
     * Coordinates in format [x, y]
     * @var array
     */
    private $coordinates;

    /**
     * An integer representing the direction
     * @var int
     */
    private $direction;

    public function __construct(array $coordinates = [0, 0], int $direction = 0)
    {
        $this->coordinates = $coordinates;
        $this->direction = $direction;
    }

    /**
     * @inheritDoc
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function setCoordinates(array $coordinates): CoordinateInterface
    {
        // TODO: Validate coordinates in correct format
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDirection(): int
    {
        return $this->direction;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function setDirection(int $direction): DirectionInterface
    {
        // TODO: Validate direction
        $this->direction = $direction;
        return $this;
    }
}
