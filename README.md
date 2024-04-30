## Instalace

Používám docker pro vývoj, takže je potřeba mít nainstalovaný docker. Pro spuštění aplikace je potřeba spustit příkaz
"./vendor/bin/sail up" a nebo pokud máte nainstalované globálně jako alias tak pomocí "sail up"

-   Následně je potřeba spustit migrace pomocí příkazu "sail artisan migrate"
-   Spustíme "sail artisan db:seed" pro naplnění databáze daty

## Úkol 1

-   Na adrese http://localhost/api/dates/date-info?date=2024-12-24 vyzkoušíme datum

## Úkol 2

-   Post http://localhost/api/tasks/completion-time

```
 {
    "start_datetime": "2024-04-29 10:00:00",
    "duration_minutes": 480,
    "workday_only": true,
    "work_start_time": "08:00:00",
    "work_end_time": "17:00:00"
}

```

## Testy

-   Nejdříve je potřeba spustit migrace pomocí příkazu "sail artisan migrate --env=testing"
-   Spustíme "sail artisan db:seed --env=testing" pro seedování databáze
-   Pro spuštění testů je potřeba spustit příkaz "sail test --env=testing"
