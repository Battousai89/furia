project-build:
	docker-compose up nginx --build -d
	docker-compose run --rm composer install
	docker-compose run --rm artisan migrate

project-up:
	docker-compose up nginx -d

project-down:
	docker-compose down -v
