export red=`tput setaf 1`
export green=`tput setaf 2`
export magenta=`tput setaf 5`
export reset=`tput sgr0`

os=windows linux

project-build:
	@echo "${magenta}Загрузка и запуск контейнеров...${reset}"
	@if [ $(os) = "linux" ]; then \
  		mkdir ./_docker/pgsql/db_data; \
  		docker-compose up --build -d nginx; \
  		cp ./backend/.env.example ./backend/.env; \
  	else \
  	  	mkdir _docker\pgsql\db_data; \
  	  	docker-compose up nginx --build -d; \
  	  	copy backend\.env.example backend\.env; \
  	fi
	@echo "${magenta}Установка зависимостей композера...${reset}"
	@make -s composer-install
	@echo "${magenta}Запуск миграций...${reset}"
	@make -s artisan-migrate-seed
	@echo "${magenta}Генерация ключа приложения...${reset}"
	@make -s artisan-keygen
	@echo "${magenta}Добавление тестовго пользователя...${reset}"
	@make artisan-add-test-user
	@echo "${magenta}Готово${reset}"

project-up:
	@echo "${magenta}Запуск контейнеров...${reset}"
	@if [ $(os) = "linux" ]; then \
		docker-compose up -d nginx; \
	else \
		docker-compose up nginx -d; \
	fi
	@echo "${magenta}Готово${reset}"

project-down:
	@echo "${magenta}Остановка и удаление контейнеров...${reset}"
	docker-compose down -v
	@echo "${magenta}Готово${reset}"

project-up-windows:
	@make -s project-up os=windows

project-up-linux:
	@make -s project-up os=linux

project-build-windows:
	@make -s project-build os=windows

project-build-linux:
	@make -s project-build os=linux

composer-install:
	docker-compose run --rm composer install

artisan-migrate:
	docker-compose run --rm artisan migrate

artisan-migrate-seed:
	docker-compose run --rm artisan migrate --seed

artisan-rollback-migration:
	docker-compose run --rm artisan migrate:rollback

artisan-keygen:
	docker-compose run --rm artisan key:generate

artisan-make-test:
	docker-compose run --rm artisan make:test $(testName)

artisan-make-unit-test:
	docker-compose run --rm artisan make:test $(testName) --unit

artisan-make-pest-test:
	docker-compose run --rm artisan make:test $(testName) --pest

artisan-test:
	docker-compose run --rm artisan test

artisan-add-test-user:
	docker-compose run --rm artisan orchid:admin admin admin@admin.com password
