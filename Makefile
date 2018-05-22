DOCKER_COMPOSE=docker-compose
DOCKER_COMPOSE_RUN=$(DOCKER_COMPOSE) run --rm -u $$(id -u):$$(id -u)
NODE=$(DOCKER_COMPOSE_RUN) node

up:
	$(DOCKER_COMPOSE) up -d --remove-orphans

down:
	$(DOCKER_COMPOSE) down --remove-orphans

watch:
	$(NODE) yarn run encore dev --watch

encore:
	$(NODE) yarn run encore production

install:
	$(NODE) yarn

dossier:
	asciidoctor-pdf docs/*.adoc
	zip -j BOISSINOT\ Pierre\ –\ Dossier\ RAO.zip docs/*.pdf