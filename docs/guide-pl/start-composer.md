Konfiguracja Composera
======================

Po zainstalowaniu szablonu projektu dobrze jest zmodyfikować domyślny plik `composer.json`, znajdujący się w głównym 
folderze:

```json
{
    "name": "yiisoft/yii2-app-advanced",
    "description": "Yii 2 Advanced Project Template",
    "keywords": ["yii2", "framework", "advanced", "project template"],
    "homepage": "http://www.yiiframework.com/",
    "type": "project",
    "license": "BSD-3-Clause",
    "support": {
        "issues": "https://github.com/yiisoft/yii2/issues?state=open",
        "forum": "http://www.yiiframework.com/forum/",
        "wiki": "http://www.yiiframework.com/wiki/",
        "irc": "irc://irc.freenode.net/yii",
        "source": "https://github.com/yiisoft/yii2"
    },
    "minimum-stability": "dev",
    "require": {
        "php": ">=5.4.0",
        "yiisoft/yii2": "~2.0.6",
        "yiisoft/yii2-bootstrap": "~2.0.0",
        "yiisoft/yii2-swiftmailer": "~2.0.0"
    },
    "require-dev": {
        "yiisoft/yii2-debug": "~2.0.0",
        "yiisoft/yii2-gii": "~2.0.0",
        "yiisoft/yii2-faker": "~2.0.0",

        "codeception/base": "^2.2.3",
        "codeception/verify": "~0.3.1"
    },
    "config": {
        "process-timeout": 1800
    },
    "extra": {
        "asset-installer-paths": {
            "npm-asset-library": "vendor/npm",
            "bower-asset-library": bower-asset
        }
    }
}
```

Zacznijmy od podstawowych informacji. Zmień `name` (nazwę), `description` (opis), `keywords` (słowa kluczowe), 
`homepage` (stronę domową) i `support` (adresy serwisów wsparcia projektu) na odpowiednie dla Twojego projektu.

Teraz czas na interesującą część - w sekcji `require` możesz dodać więcej pakietów zależności, których wymaga Twoja 
aplikacja. Pakiety te są pobierane poprzez serwis [packagist.org](https://packagist.org/) - zerknij na jego zasoby 
w poszukiwaniu przydatnego kodu.

Po aktualizacji pliku `composer.json` możesz uruchomić komendę `composer update --prefer-dist` - nowe pakiety zostaną 
pobrane i zainstalowane i będą od razu gotowe do użycia. Autoładowanie klas jest obsługiwane automatycznie.
