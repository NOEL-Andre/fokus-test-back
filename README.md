# Test Dev Back Fokus

## Installation

- Clone or download the repository
- Run `docker-compose build --pull --no-cache` at root of the project
- Run `docker-compose up -d` at root of the project

- Connect to docker php service and run `php bin/console doctrine:databas:create` to create api database if not exists
- Connect to docker php service and run `APP_ENV=test php bin/console doctrine:databas:create` to create api_test database if not exists

- Connect to docker php service and run `php bin/console doctrine:migrations:migrate` to create database schema
- Connect to docker php service and run `APP_ENV=test php bin/console doctrine:migrations:migrate` to create database schema for test environment

- Connect to docker php service and run `php bin/console doctrine:fixtures:load` to load fixtures
- Connect to docker php service and run `APP_ENV=test php bin/console doctrine:fixtures:load` to load fixtures for test environment

## URLS
 - API : https://localhost
 - API DOC : https://localhost/docs

## Tests

- Connect to docker php service and run `php bin/phpunit` to run tests or use PhpStorm to run tests (see all_tests.run.xml in project)
