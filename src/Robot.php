<?php

namespace IkeLutra\RedBadger;

class Robot implements CoordinateInterface
{
    /**
     * Coordinates in format [x, y]
     *
     * @var array
     */
    private $coordinates;

    public function __construct(array $coordinates = [0, 0])
    {
        $this->coordinates = $coordinates;
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
     */
    public function setCoordinates(array $coordinates): CoordinateInterface
    {
        $this->coordinates = $coordinates;
        return $this;
    }
}
