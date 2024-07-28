####################################################################################################
####                                         ENVIRONMENT                                        ####
####################################################################################################

export MY_UID ?= $(shell id -u)
export MY_GID ?= $(shell id -g)

export FORCE_BUILD ?=

export DOCKER_COMPOSE = docker-compose.yml

include ./.env
export $(shell sed 's/=.*//' ./.env)

#include ./project/.env.test.local
#export $(shell sed 's/=.*//' ./project/.env.test.local)

####################################################################################################
####                                           STACK                                            ####
####################################################################################################

########## usage ##########
help:
	@echo "Usage: make TARGET"
	@echo "Targets:"
	@echo "  build:           docker-compose build"
	@echo "  up:              docker-compose up"
	@echo "  start:           docker-compose up -d"
	@echo "  stop:            docker-compose stop"
	@echo "  clear:           docker exec -u ${MY_UID}:${MY_GID} -it app bin/console cache:clear"
	@echo "  warmup:          docker exec -u ${MY_UID}:${MY_GID} -it app bin/console cache:warmup"
	@echo "  migrate:         docker exec -u ${MY_UID}:${MY_GID} -it app bin/console do:mi:mi"
	@echo "  create-db:       create database"

########## main targets ##########
build: docker-compose-build
up: docker-compose-up
start: docker-compose-start
stop: docker-compose-stop
restart: docker-compose-restart
clear: console-cache-clear
warmup: console-cache-warmup
########## /main targets ##########

docker-compose-config: docker-compose.yml

docker-compose-build-app: docker-compose-config
	docker compose -f ${DOCKER_COMPOSE} build ${FORCE_BUILD} --build-arg UID=${MY_UID} --build-arg GID=${MY_GID} back

docker-compose-build: docker-compose-build-app

docker-compose-up: docker-compose-config
	docker compose -f ${DOCKER_COMPOSE} up

docker-compose-start: docker-compose-config
	docker compose -f ${DOCKER_COMPOSE} up -d
	docker exec -u ${MY_UID}:${MY_GID} -it symfony-back composer install
	docker exec -u ${MY_UID}:${MY_GID} -it symfony-back bin/console cache:warmup

docker-compose-stop:
	docker compose -f ${DOCKER_COMPOSE} stop

docker-compose-restart:
	$(MAKE) stop
	$(MAKE) start

console-cache-warmup: docker-compose-config
	docker exec -u ${MY_UID}:${MY_GID} -it app bin/console cache:warmup

console-cache-clear: docker-compose-config
	docker exec -u ${MY_UID}:${MY_GID} -it app bin/console cache:clear

migrate-database: docker-compose-config
	docker exec -u ${MY_UID}:${MY_GID} -it app bin/console do:mi:mi

create-db:
	docker exec -it mysql-db mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY '${MYSQL_ROOT_PASSWORD}'; FLUSH PRIVILEGES;"
	docker exec -u ${MY_UID}:${MY_GID} -it symfony-back bin/console doctrine:database:create
	docker exec -u ${MY_UID}:${MY_GID} -it symfony-back bin/console do:mi:mi
	docker exec -u ${MY_UID}:${MY_GID} -it symfony-back bin/console fixtures:load


