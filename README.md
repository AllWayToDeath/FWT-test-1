# FWT-test-1

ОС: ubuntu 

Должны быть установлены docker и docker-compose

```
docker-compose up -d --build
docker-compose exec app composer i
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
```

Переходим по адресу: http://0.0.0.0:8080/register
