<?php

namespace IkeLutra\RedBadger;

interface CoordinateInterface
{
    /**
     * Returns coordinates in [x, y] format
     */
    public function getCoordinates(): array;
    /**
     * Allows setting of coordinates in [x, y] format
     */
    public function setCoordinates(array $coordinates): self;
}
