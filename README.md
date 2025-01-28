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

**Запуск миграций:**

```bash
./vendor/bin/sail artisan migrate
```

**Запуск сидера для заполнения бд:**

```bash
./vendor/bin/sail artisan db:seed --class=OrderSeeder
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

## Использование:

**Заходим на *http://localhost* и Нажимаем на кнопку экспорт файлов, затем переходим *http://localhost/files***

### Ссылки:

**PhpMyAdmin**

```bash
http://localhost:8081
```
