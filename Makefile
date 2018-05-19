DOCKER_COMPOSE_RUN=docker-compose run --rm -u $$(id -u):$$(id -u)
NODE=$(DOCKER_COMPOSE_RUN) node

watch:
	$(NODE) yarn run encore dev --watch

install:
	$(NODE) yarn