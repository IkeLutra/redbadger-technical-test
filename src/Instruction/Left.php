<?php

namespace IkeLutra\RedBadger\Instruction;

use IkeLutra\RedBadger\DirectionInterface;

class Left extends ChangeDirection
{
    protected $directionModifier = -1;
}