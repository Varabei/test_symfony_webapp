Приложение запускается в docker-контейнерах.  
В качестве сервера используется локальный сервер Symfony, запускаемый внутри контейнера.
Используется база данных MySql.

Для запуска выполнить две команды: 

    docker-compose up -d
    docker-compose exec web symfony console doctrine:migrations:migrate --no-interaction

Приложение будет доступно по адресу: http://localhost:8000