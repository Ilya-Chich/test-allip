Prerequisites:
- Considering you have got a Linux/MacOS local environment
- Install `docker`, `docker-compose` with Compose file format v3.7 https://docs.docker.com/compose/compose-file/compose-file-v3/ and `build-essential` packages (+ add current user to group `docker`)
- `git clone git@github.com:Ilya-Chich/test-allip.git`
- cd to cloned project
- make command `cp .env.example .env`

Usage:
- make command `make app-start-dev` with xdebug extension or `make app-start-prod` without it (Actually this command is a mock I didn't have time to set up prod env, but for some reason I have prepared supervisor configuration for potential transforming my task to daemon)
- start container bash with `make exec-php-fpm`
- run the first task with command `php /opt/www/artisan parse:phones --i=input.txt --o=output.txt --d=db.txt`
- output file is now being located in the directory `storage/app/`
- codebase for the first task is located in app/Console/Commands/FirstExample.php
- copy vendor folder from container `make docker-cp-vendor` (if needed)
