Installation
------

1. Execute (for `vendor` dependencies)

```console
composer require grinway/web-app-bundle
```

> NOTE: With the help of the composer recipe you will get<br>`config/packages/grinway_web_app.yaml`

If you didn't get these configuration files just copy them from `@GrinWayService/.install/symfony/config`

> **WARNING**: `2.` and `3.` contain `!IMPORTANT TO DO!`
> <br>**essentially** do this

2. Add this to your `bundles.php`

```php
<?php

// %kernel.project_dir%/config/bundles.php
return [
    GrinWay\WebApp\GrinWayWebAppBundle::class => ['all' => true],
    
    // !IMPORTANT TO DO!
    // If you have DebugBundle ADD THIS: 'test' => true
    // It's for AbstractWebAppTestCase class of this bundle
    Symfony\Bundle\DebugBundle\DebugBundle::class => ['test' => true, 'dev' => true],
];
```

3. Fix the default `%kernel.project_dir%/config/packages/web_profiler.yaml` file:

```yaml
when@dev:
    web_profiler:
        toolbar: true
        intercept_redirects: false

    framework:
        profiler:
            only_exceptions: false
            collect_serializer_data: true

when@test:
    web_profiler:
        toolbar: false
        intercept_redirects: false

    framework:
        # !IMPORTANT TO DO! (collect: true)
        profiler: { enabled: true, collect: true }
```

4. Execute (for `node_modules` dependencies)

```console
yarn install --force
```

Ensure you have in your `%kernel.project_dir%/assets/controllers.json` what typed below:

```json
"@grinway/web-app-bundle": {
    "transition": {
        "fetch": "eager",
        "autoimport": {
            "@grinway/web-app-bundle/dist/style/transition.css": true
        },
        "enabled": true
    }
},
```

If precipice didn't insert it automatically copy and paste it
