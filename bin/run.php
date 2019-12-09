#!/usr/bin/env php
<?php

use IkeLutra\RedBadger\InputParser;
use IkeLutra\RedBadger\MoveRobotsCommand;
use IkeLutra\RedBadger\OutputFormatter;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();
$app->add(new MoveRobotsCommand(new InputParser, new OutputFormatter));
$app->run();
