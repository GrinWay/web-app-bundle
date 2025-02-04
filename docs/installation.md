Installation
------

1. Execute (for `vendor` dependencies)

```console
composer require grinway/web-app-bundle
```

> NOTE: With the help of the composer recipe you will get<br>`config/packages/grinway_web_app.yaml`

If you didn't get these configuration files just copy them from `@GrinWayService/.install/symfony/config`

2. Add this to your `bundles.php`

```php
<?php

// %kernel.project_dir%/config/bundles.php
return [
    GrinWay\WebApp\GrinWayWebAppBundle::class => ['all' => true],
    // If you have DebugBundle ADD THIS: 'test' => true
    // It's for AbstractWebAppTestCase class of this bundle
    Symfony\Bundle\DebugBundle\DebugBundle::class => ['test' => true, 'dev' => true],
];
```

[//]: # (3. Execute &#40;for `node_modules` dependencies&#41;)

[//]: # (```console)
[//]: # (yarn install --force)
[//]: # (```)

[//]: # (3. Set all ENV variables of this bundle &#40;required by the `config/packages/grinway_web_app.yaml` file&#41;:)
[//]: # ()
[//]: # (```env)
[//]: # (###> grinway/web-app-bundle ###)
[//]: # ()
[//]: # (#)
[//]: # (# to be more secure)
[//]: # (# set this to the symfony secrets https://symfony.com/doc/current/configuration/secrets.html)
[//]: # (#)
[//]: # (APP_CURRENCY_FIXER_API_KEY=)
[//]: # ()
[//]: # (###< grinway/web-app-bundle ###)
[//]: # (```)
