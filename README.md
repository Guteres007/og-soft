## Instalace

Používám docker pro vývoj, takže je potřeba mít nainstalovaný docker. Pro spuštění aplikace je potřeba spustit příkaz
"./vendor/bin/sail up" a nebo pokud máte nainstalované globálně jako alias tak pomocí "sail up"

-   Následně je potřeba spustit migrace pomocí příkazu "sail artisan migrate"
-   Spustíme "sail artisan db:seed" pro naplnění databáze daty
-   Na adrese http://localhost/api/dates/date-info?date=2024-12-24 vyzkoušíme datum

## Testy

-   Nejdříve je potřeba spustit migrace pomocí příkazu "sail artisan migrate --env=testing"
-   Spustíme "sail artisan db:seed --env=testing" pro seedování databáze
-   Pro spuštění testů je potřeba spustit příkaz "sail test --env=testing"
