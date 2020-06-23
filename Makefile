.PHONY: install serve scheduler

install:
	composer install
	npm install
	php artisan key:generate
	touch appointments.db
	php artisan migrate

scheduler:
	while true; do php artisan schedule:run; sleep 60; done

serve-setup:
	php artisan serve --host=127.0.0.1
open-browser:
	python3 -m webbrowser "http://127.0.0.1:8000"; 
serve: open-browser serve-setup
