# currency_rates_cbr
Интеграция с REST API Центрального Банка России

### Запуск
- cp .env.example .env
- php artisan optimize
- chmod -R 777 storage/logs
- docker-compose up -d --build

### Тестирование
./vendor/bin/phpunit tests/.

### Исправить форматирование
```shell
php php-cs-fixer.phar fix
./vendor/bin/phpstan analyse
``` 

```shell
  POST       _ignition/execute-solution .................................................. ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD   _ignition/health-check .............................................................. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST       _ignition/update-config ........................................................... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD   api/currency_rates_daily ........................................................................... api.currency_rates_daily › API\ExchangeRatesController
  GET|HEAD   horizon/api/batches ................................................................ horizon.jobs-batches.index › Laravel\Horizon › BatchesController@index
  POST       horizon/api/batches/retry/{id} ..................................................... horizon.jobs-batches.retry › Laravel\Horizon › BatchesController@retry
  GET|HEAD   horizon/api/batches/{id} ............................................................. horizon.jobs-batches.show › Laravel\Horizon › BatchesController@show
  GET|HEAD   horizon/api/jobs/completed ................................................. horizon.completed-jobs.index › Laravel\Horizon › CompletedJobsController@index
  GET|HEAD   horizon/api/jobs/failed .......................................................... horizon.failed-jobs.index › Laravel\Horizon › FailedJobsController@index
  GET|HEAD   horizon/api/jobs/failed/{id} ....................................................... horizon.failed-jobs.show › Laravel\Horizon › FailedJobsController@show
  GET|HEAD   horizon/api/jobs/pending ....................................................... horizon.pending-jobs.index › Laravel\Horizon › PendingJobsController@index
  POST       horizon/api/jobs/retry/{id} ............................................................. horizon.retry-jobs.show › Laravel\Horizon › RetryController@store
  GET|HEAD   horizon/api/jobs/silenced .................................................... horizon.silenced-jobs.index › Laravel\Horizon › SilencedJobsController@index
  GET|HEAD   horizon/api/jobs/{id} ........................................................................... horizon.jobs.show › Laravel\Horizon › JobsController@show
  GET|HEAD   horizon/api/masters ............................................................ horizon.masters.index › Laravel\Horizon › MasterSupervisorController@index
  GET|HEAD   horizon/api/metrics/jobs ........................................................ horizon.jobs-metrics.index › Laravel\Horizon › JobMetricsController@index
  GET|HEAD   horizon/api/metrics/jobs/{id} ..................................................... horizon.jobs-metrics.show › Laravel\Horizon › JobMetricsController@show
  GET|HEAD   horizon/api/metrics/queues .................................................. horizon.queues-metrics.index › Laravel\Horizon › QueueMetricsController@index
  GET|HEAD   horizon/api/metrics/queues/{id} ............................................... horizon.queues-metrics.show › Laravel\Horizon › QueueMetricsController@show
  GET|HEAD   horizon/api/monitoring ............................................................ horizon.monitoring.index › Laravel\Horizon › MonitoringController@index
  POST       horizon/api/monitoring ............................................................ horizon.monitoring.store › Laravel\Horizon › MonitoringController@store
  GET|HEAD   horizon/api/monitoring/{tag} ............................................ horizon.monitoring-tag.paginate › Laravel\Horizon › MonitoringController@paginate
  DELETE     horizon/api/monitoring/{tag} .............................................. horizon.monitoring-tag.destroy › Laravel\Horizon › MonitoringController@destroy
  GET|HEAD   horizon/api/stats .................................................................. horizon.stats.index › Laravel\Horizon › DashboardStatsController@index
  GET|HEAD   horizon/api/workload .................................................................. horizon.workload.index › Laravel\Horizon › WorkloadController@index
  GET|HEAD   horizon/{view?} .................................................................................... horizon.index › Laravel\Horizon › HomeController@index
  GET|HEAD   up ............................................................................................................................ generated::Fw4lTihKPbBAJlQF
```
