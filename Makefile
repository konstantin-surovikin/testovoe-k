env:
	@docker compose exec --user=www-data web /bin/bash

up:
	@docker compose up -d

down:
	@docker compose down

down-v:
	@docker compose down -v

env-root:
	@docker compose exec --user=root web /bin/bash

composer-install:
	@docker compose run --rm --no-deps web composer install

build:
	@docker image inspect repository_name/repository_version:latest 1>/dev/null 2>/dev/null || ./docker/php/build.sh

build-force:
	@./docker/php/build.sh

install-xdebug:
	@docker compose exec --user=root web /usr/bin/install-php-extensions xdebug
	@docker compose restart

cp-env:
	@test -f .env || cp .env.dist .env

migrate:
	@docker compose run --no-deps --rm web php artisan migrate

seed:
	@docker compose run --no-deps --rm web php artisan migrate --seed

install: cp-env build up composer-install migrate

install-dev: install install-xdebug seed

php-stan:
	@docker compose exec web php -d memory_limit=2G vendor/bin/phpstan analyse src tests -l 9

php-test:
	@docker compose exec web php -d memory_limit=2G ./vendor/bin/phpunit
