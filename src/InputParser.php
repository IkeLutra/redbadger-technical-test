<?php

namespace IkeLutra\RedBadger;

class InputParser
{
    /**
     * Converts all the values of an array into integers
     *
     * @param array $original
     * @return array
     */
    private function convertArrayToInt(array $original): array
    {
        $new = [];
        foreach ($original as $key => $value) {
            $new[$key] = (int)$value;
        }
        return $new;
    }

    /**
     * Converts a direction string into the relevant integer
     *
     * @param string $letter
     * @return integer
     */
    private function convertDirectionToInt(string $letter): int
    {
        // TODO: Abstract this to its own class
        switch (strtoupper($letter)) {
            case 'E':
                $number = 1;
                break;
            case 'S':
                $number = 2;
                break;
            case 'W':
                $number = 3;
                break;
            case 'N':
            default:
                $number = 0;
                break;
        }
        return $number;
    }

    /**
     * Parses a multi-line string into
     * A map based on the coordinates on the first line
     * An array of robots with their matching instruction strings
     *
     * @param string $input
     * @return array
     */
    public function parse(string $input): array
    {
        $lines = preg_split("/\r\n|\n|\r/", $input);
        $parsed = [];
        if (isset($lines[0])) {
            $coordinates = $this->convertArrayToInt(explode(' ', $lines[0]));
            $parsed['map'] = new Map($coordinates);
        }
        $entries = [];
        $entry = [];
        foreach ($lines as $i => $line) {
            if ($i !== 0) {
                if (preg_match('/^\d+/', $line) === 1) {
                    // Starts with digit so position line
                    $position = explode(' ', $line);
                    $direction = $this->convertDirectionToInt($position[2]);
                    $coordinates = $this->convertArrayToInt([$position[0], $position[1]]);
                    $entry['robot'] = new Robot($coordinates, $direction);
                } elseif (preg_match('/^[A-Z]+/', $line) === 1) {
                    $instructions = preg_split('//', trim($line), -1, PREG_SPLIT_NO_EMPTY);
                    $entry['instructions'] = $instructions;
                    $entries[] = $entry;
                    $entry = [];
                }
            }
        }
        $parsed['entries'] = $entries;
        return $parsed;
    }
}
