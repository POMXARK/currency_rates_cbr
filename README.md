# currency_rates_cbr
Интеграция с REST API Центрального Банка России

### Запуск
- cp .env.example .env
- php artisan optimize
- chmod -R 777 storage/logs
- docker-compose up -d --build

### Тестирование
./vendor/bin/phpunit tests/.
