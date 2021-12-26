build:
	docker build -t botonarioum-gateway -f Dockerfile.production .

up:
	docker run -it -p 9000:9000 --env-file .env botonarioum-gateway bash

analyse:
	php vendor/bin/phpstan.phar analyse app/

infrastructure:
	terraform init
	terraform apply