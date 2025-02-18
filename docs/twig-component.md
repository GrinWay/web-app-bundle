Twig components
------

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

        <!-- "top", "sticky", "normal" -->
        position="sticky"

        <!-- values for "grinway-web-app--transition" stimulus controller -->
        initShown="{{ false }}"
        willLeave="{{ true }}"
        removeAfterLeave="{{ true }}"
        style="fade"
        disappearInMs="5000"
>Hello Grinway Alert</twig:grinway:Alert>
```

[//]: # (### `twig:grinway:Flash`)
[//]: # ()
[//]: # (Usage:)
