# Phone Calls Laboratory Project

Лабораторний проєкт складається з двох частин:

- `phone-calls-system` - Laravel backend з API, моделями, міграціями та адмін-сторінками.
- `phone-calls-react` - React frontend з каталогом дзвінків, фільтрами та сторінкою деталей.

## Запуск backend

```bash
cd phone-calls-system
composer install
npm install
php artisan migrate
php artisan serve
```

## Запуск frontend

```bash
cd phone-calls-react
npm install
npm run dev
```

Frontend очікує Laravel API за адресою `http://127.0.0.1:8000/api`.
