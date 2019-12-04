<?php

namespace IkeLutra\RedBadger;

interface DirectionInterface
{
    /**
     * Gets the direction as an integer
     * North - 0
     * East - 1
     * South - 2
     * West - 3
     * @var int
     */
    public function getDirection(): int;
    /**
     * Sets the direction as an integer
     * @var self
     */
    public function setDirection(int $direction): self;
}