
composer-install:
	@test ! -f vendor/autoload.php && composer install --no-dev || true

composer-install-dev:
	@test ! -d vendor/phpunit/phpunit && composer install || true

composer-update:
	@composer update --no-dev

composer-update-dev:
	@composer update

#dev-phan-analyse: composer-install-dev
#	@./vendor/bin/phan -k=.phan --color --allow-polyfill-parser || true
#
#dev-phan-report: dev-phan-save
#	@php vendor/ceus-media/phan-viewer/phan-viewer generate --source=phan.json --target=doc/phan/
#
#dev-phan-save: composer-install-dev
#	@./vendor/bin/phan -k=.phan -m=json -o=phan.json --allow-polyfill-parser -p || true

#dev-doc: composer-install-dev
#	@test -f doc/API/search.html && rm -Rf doc/API || true
#	@php vendor/ceus-media/doc-creator/doc.php --config-file=doc.xml

dev-test: composer-install-dev
	@vendor/bin/phpunit -v || true

dev-test-syntax:
	@find src -type f -print0 | xargs -0 -n1 xargs php -l

dev-phpstan:
#	@vendor/bin/phpstan analyse src --level=5
	@vendor/bin/phpstan analyse --configuration phpstan.neon --xdebug || true

dev-phpstan-save-baseline:
	@vendor/bin/phpstan analyse --configuration phpstan.neon --generate-baseline phpstan-baseline.neon || true

dev-psalm:
	@vendor/bin/psalm --show-info=true

