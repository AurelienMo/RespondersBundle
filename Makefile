EXEC_PHP        = php
COMPOSER        = composer

##
## ALIAS
## -------
##

cs: phpcs
stan: phpstan
cbf: phpcbf
tu: test-unit
metrics: phpmetrics


##
## Project
## -------
##

.DEFAULT_GOAL := help

help: ## Default goal (display the help message)
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-20s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

.PHONY: help

##
## Tools
## ------
##

phpcs: ## Run phpcs
phpcs: vendor/bin/phpcs
	vendor/bin/phpcs

phpstan: ## Run phpstan
phpstan: vendor/bin/phpstan
	vendor/bin/phpstan analyze . --level=7

phpcbf: ## Run PHPCBF
phpcbf: vendor/bin/phpcbf
	vendor/bin/phpcbf

phpmetrics: ## Run phpmetrics
phpmetrics: vendor/bin/phpmetrics
	vendor/bin/phpmetrics --report-html="./var/phpmetrics" ./src


##
## Manage Dependencies
## ------
##

vendor: ## Install composer dependecies
vendor: composer.lock
	$(COMPOSER) install -n --prefer-dist

new-vendor: ## Require new dependency
new-vendor: composer.json
	$(COMPOSER) require $(DEP)

new-dev-vendor: ## Require new dev dependency
new-dev-vendor: composer.json
	$(COMPOSER) require $(DEP) --dev

remove-vendor: ## Remove dependency
remove-vendor: composer.json
	$(COMPOSER) require $(DEP) --dev

##
## TESTS
## ------
##
test-unit: ## Run phpunit
test-unit: tests
	vendor/bin/phpunit
