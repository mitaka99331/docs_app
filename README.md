#To start the project:
1. Run `docker-compose build --build-arg UID=$(id -u) --build-arg GID=$(id -g)`
2. Run `docker-compose up -d`
3. Run `docker exec php composer install`
4. Run `docker exec php composer db-init`
5. Run `docker exec php yarn install && docker exec php yarn encore dev`
#To stop the project:
####Run `docker-compose down`

##Useful commands
#### Run `composer cs-fix`
#### Run `composer phpstan`

##Migrations
#### Run `php bin/console doctrine:migrations:migrate`

##Mock Data
#### Run `php bin/console doctrine:fixtures:load`
