# Red Badger Technical Test

## Requirements

- Docker
- docker-compose

OR 

- PHP 7.4
- Composer

## Setup

If using docker run:
```
docker-compose run composer install
```

If using local php run:
```
composer install
```

## Running command
If using docker run:
```
docker-compose run php move:robots example_input.txt
```
Replacing `example_input.txt` with the path to a input file (NOTE: due to how docker mounts directories the file must be in the repository folder)

If using local php run:
```
php bin/run.php move:robots example_input.txt
```
Replacing `example_input.txt` with the path to a input file

## Running tests

Using local php:
```
vendor/bin/phpunit tests/
```