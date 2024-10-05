# Variables
PROJECT_NAME=laravel_db
DOCKER_COMPOSE=docker-compose
EXEC_APP=$(DOCKER_COMPOSE) exec app
EXEC_DB=$(DOCKER_COMPOSE) exec mysql

help:
	@echo "Commands on Makefile:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: ## Create Laravel project in src folder
	@if [ ! -d "./src" ]; then \
		$(DOCKER_COMPOSE) run --rm app composer create-project laravel/laravel .; \
		echo "Proyecto Laravel creado en ./src"; \
	else \
		echo "El directorio ./src ya existe"; \
	fi

start: ## Up Docker containers
	$(DOCKER_COMPOSE) up -d

status: ## Container status of the project
	$(DOCKER_COMPOSE) ps -a

stop: ## Stop all containers
	$(DOCKER_COMPOSE) down

shell-app: ## Enter into backend container shell (Laravel)
	$(EXEC_APP) bash

shell-db: ## Enter into MySQL container shell
	$(EXEC_DB) bash

test: ## Execute unit & acceptance tests
	$(EXEC_APP) ./vendor/bin/phpunit

phpstan: ## Execute PHPStan
	$(EXEC_APP) ./vendor/bin/phpstan analyse . --level=max

lint: ## Fix  PHP CS Fixer
	$(EXEC_APP) ./vendor/bin/php-cs-fixer fix .

install-dependencies: ## Install all depencencies of PHP & NPM
	$(EXEC_APP) composer install
	$(EXEC_APP) npm install

migrate: ## Execute migrations
	$(EXEC_APP) php artisan migrate

ci: migrate test lint ## Execute CI project

#TODO: phpstan is missing
clean: ## Clean all container
	$(DOCKER_COMPOSE) down -v --remove-orphans

restart: stop start ## Restart project

cache-clear: ## Cache clear of project
	$(EXEC_APP) php artisan config:clear
	$(EXEC_APP) php artisan cache:clear