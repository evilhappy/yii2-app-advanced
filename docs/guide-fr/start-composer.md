Configuration de Composer
========================

Après avoir installé le modèle de projet, il est conseillé d'ajuster le contenu de `composer.json` qui se trouve dans le dossier racine :

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

Commencez par mettre les informations de base à jour. Modifiez `name`, `description`, `keywords`, `homepage` et `support` pour qu'ils correspondent à votre projet.

Maintenant, vient la partie intéressante. Vous pouvez ajouter des paquets nécessaires à votre application dans la section `require`. 
Tous ces paquets proviennent de [packagist.org](https://packagist.org/), c'est pourquoi vous ne devez pas hésiter à parcourir le site Web pour trouver du code utile. 

Après avoir modifié votre fichier `composer.json`, vous pouvez exécuter  `composer update --prefer-dist`, et attendre tout simplement le téléchargement et l'installation des paquets pour les utiliser. L'auto-chargement des classes est pris en charge automatiquement. 
