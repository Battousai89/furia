os=win linux

project-build:
	if [ "os" = "linux" ]; then \
  		docker-compose up --build -d nginx; \
  	else \
  	  	docker-compose up nginx --build -d; \
  	fi;
	docker-compose run --rm composer install
	docker-compose run --rm artisan migrate

project-up:
	docker-compose up -d nginx

project-down:
	docker-compose down -v
