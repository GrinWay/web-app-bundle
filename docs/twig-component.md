Twig components
------

> Before usage REMOVE html comments inside twig component to make it work

### `twig:grinway:Alert`

Usage:

```html
<!-- twig template -->

<twig:grinway:Alert
        <!-- "primary", "secondary", "success", "danger", "warning", "info", "light", "dark" -->
        type="secondary"

        <!-- "left", "center", "right" -->
        alignment="center"

        <!-- "lg", "md", "sm", "normal" -->
        size="lg"

        <!-- "top", "sticky", "absolute", "normal" -->
        position="sticky"

        <!-- values for "grinway-web-app--transition" stimulus controller -->
        initShown="{{ false }}"
        willLeave="{{ true }}"
        removeAfterLeave="{{ true }}"
        style="fade"
        disappearInMs="5000"
>Hello Grinway Alert</twig:grinway:Alert>
```

### `twig:grinway:Flash`
Usage:

```html
<!-- twig template -->

<twig:grinway:Flash
        <!-- "top", "sticky", "absolute", "normal" -->
        position="sticky"
        <!-- not clear flash from symfony flash bag -->
        <!-- can be highly useful for turbo frames, streams -->
        <!-- usually you'll use peak="{{ true }}" by default -->
        peek="{{ false }}"

        <!-- values for "grinway-web-app--transition" stimulus controller -->
        initShown="{{ false }}"
        willLeave="{{ false }}"
        removeAfterLeave="{{ true }}"
        style="fade"
        disappearInMs="1000"
/>
```

```php
<?php

// controller or service code

use GrinWay\Service\Type\NoteType;

//...

public function someSymfonyControllerMethod(): void {
    $this->addFlash(
        NoteType::NOTICE,
        'NOTICE FLASH MESSAGE',
    );
    $this->addFlash(
        NoteType::ERROR,
        'ERROR FLASH MESSAGE',
    );
    $this->addFlash(
        NoteType::WARNING,
        'WARNING FLASH MESSAGE',
    );
    $this->addFlash(
        'secondary',
        'SECONDARY FLASH MESSAGE',
    );
    $this->addFlash(
        'NOT STANDARD KEY',
        'NOT STANDARD KEY and rest will show up as primary',
    );
}

```
