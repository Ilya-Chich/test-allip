### Create project
app-start-prod: app-build-prod app-up-prod
app-start-dev: app-build-dev app-up-dev

app-build-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml build
app-build-no-cache-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml build --no-cache
app-up-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml up -d
app-up-no-detach-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml up
app-stop-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml stop
app-down-prod:
	docker-compose -f docker-compose.yml -f docker-compose-prod.yml down

app-build-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml build --build-arg user=$(shell whoami) --build-arg uid=$(shell id -u)
app-build-no-cache-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml build --build-arg user=$(shell whoami) --build-arg uid=$(shell id -u) --no-cache
app-up-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up -d
app-up-no-detach-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml up
app-stop-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml stop
app-down-dev:
	docker-compose -f docker-compose.yml -f docker-compose-dev.yml down

### start container bash
exec-php-fpm:
	docker-compose exec allip-test-php-fpm bash

### copy vendor files to local fs
docker-cp-vendor:
	rm -rf ./vendor/*
	docker cp allip-test-php-fpm:/opt/www/vendor/. ./vendor

### mock for tests
app-tests:
	docker-compose exec allip-test-php-fpm phpunit
