# systemeio

### Запуск проекта:
* `docker-compose build`
* `docker-compose up -d`
* `docker exec -it _название php контейнера_ /bin/bash`
* Внутри контейнера для запуска миграций выполняем `php bin/console doctrine:migrations:migrate --no-interaction`

### Запуск тестов:
* Внутри контейнера выполняем `vendor/bin/phpunit`
* Запуск phpstan `vendor/bin/phpstan`

### Примеры:
* Примеры валидных запросов указаны в файле `requests.http`