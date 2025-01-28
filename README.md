# Laravel Order Export to XML Project

**Настройка окружения:**

```bash
cp .env.sail .env
```

**Установка зависимостей:**

```bash
composer install
```

**Запуск Laravel Sail:**

```bash
./vendor/bin/sail up -d
```

**Запуск миграций и заполнение БД тестовыми данными:**

```bash
./vendor/bin/sail artisan migrate --seed
```

**Запуск обработчик очередей (для обработки задач экспорта):**

```bash
./vendor/bin/sail artisan queue:work
```

**Тесты:**

```bash
./vendor/bin/sail artisan test
```

**Файлы сохраняются в директории */app/private/exports***

## Ссылки:

**PhpMyAdmin**

```bash
http://localhost:8081
```
