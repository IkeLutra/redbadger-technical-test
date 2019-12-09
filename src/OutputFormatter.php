<?php

namespace IkeLutra\RedBadger;

class OutputFormatter
{
    /**
     * Converts direction number into a letter
     *
     * @param integer $number
     * @return string
     */
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
    /**
     * Takes robot and formats a string for output
     * containing coordinates, direction and whether it is lost
     *
     * @param Robot $robot
     * @return void
     */
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
