SHELL=bash
SOURCE_DIR = $(shell pwd)
COMPOSER_DIR = ${SOURCE_DIR}/composer
COMPOSER_BIN := $(shell type -P composer2)
DOCKER_COMPOSE_BIN ?= docker-compose
EXEC = $(DOCKER_COMPOSE) exec
RUN = $(DOCKER_COMPOSE) run

DOCKER_COMPOSE = DOCKER_UID=$(shell id -u) $(DOCKER_COMPOSE_BIN) -f compose.yaml
DOCKER_COMPOSE += -f compose.local.yaml
VENDOR_BIN_DIR = vendor/bin/
PHP = $($(CURRENT_EXEC_PHP))

# Coding Style
cs:
	$(VENDOR_BIN_DIR)php-cs-fixer fix --dry-run --stop-on-violation --diff

cs-fix:
	$(VENDOR_BIN_DIR)php-cs-fixer fix --config=.php-cs-fixer.dist.php --diff --allow-risky=yes

.PHONY: phpstan
phpstan:
	$(VENDOR_BIN_DIR)phpstan.phar analyse --memory-limit=1G

rector:
	$(PHP) vendor/bin/rector process

start:
	@make docker-compose.local.yaml
	@make up
	@make composer-install

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) stop

composer-install:
	composer install

compose.local.yaml:
	cp compose.local.yaml.dist compose.local.yaml
