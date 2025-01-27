# Laravel Order Export to XML Project
Этот проект позволяет экспортировать заказы в XML-файлы с использованием Laravel.

-**Установка зависимостей:**

```composer install```

-**Запуск Laravel Sail:**

```./vendor/bin/sail up -d```

-**Запуск миграций и заполнение БД тестовыми данными:**

``./vendor/bin/sail artisan migrate --seed``

-**Запуск обработчик очередей (для обработки задач экспорта):**

``./vendor/bin/sail artisan queue:work``

-**Тесты:**

``./vendor/bin/sail artisan test``

**Файлы сохраняются в директории */app/private/exports***
