<?php

namespace IkeLutra\RedBadger;

class OutputFormatter
{
    private function directionToString(int $number): string
    {
        switch ($number) {
            case 1:
                $direction = 'E';
                break;
            case 2:
                $direction = 'S';
                break;
            case 3:
                $direction = 'W';
                break;
            case 0:
            default:
                $direction = 'N';
                break;
        }
        return $direction;
    }

    public function format(Robot $robot)
    {
        $coordinates = $robot->getCoordinates();
        $direction = $this->directionToString($robot->getDirection());
        $output = "{$coordinates[0]} {$coordinates[1]} {$direction}";
        if ($robot->isLost()) {
            $output .= ' LOST';
        }
        return $output;
    }
}
