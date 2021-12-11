build:
	docker build -t botonarioum-gateway -f Dockerfile.production .

up:
	docker run -it -p 8080:8080 --env-file .env botonarioum-gateway bash

analyse:
	php vendor/bin/phpstan.phar analyse app/

dev:
	docker build . -t botonarioum-gateway-dev
	docker run -it -p 8080:8080 -v ${PWD}:/gateway/ --env-file .env botonarioum-gateway-dev composer install && php -S 0.0.0.0:8080 -t app/