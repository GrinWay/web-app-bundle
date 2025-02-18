UX stimulus controllers
------

### `grinway-web-app--transition`

Description:

Applies css transition to smoothly show then smoothly hide, or it's initially shown smoothly hide element later

Optionally remove from the DOM

Usage:

```html
<!-- it's a twig template -->
<div
        <!-- stimulus controller -->
        data-controller="grinway-web-app--transition"
        
        <!-- Required "element" target (what element you want to apply transition to?) -->
        data-grinway-web-app--transition-target="element"

        <!-- Optional value -->
        data-grinway-web-app--transition-init-shown-value="{{ true }}"
        <!-- Optional value -->
        <!-- "fade", "slide", "flash", "rotate" (see "@grinway/web-app-bundle/dist/style/transition.css") -->
        data-grinway-web-app--transition-style-value="fade"
        <!-- Optional value -->
        data-grinway-web-app--transition-disappear-in-ms-value="1000"
        <!-- Optional value -->
        data-grinway-web-app--transition-will-leave-value="{{ true }}"
        <!-- Optional value -->
        data-grinway-web-app--transition-remove-after-leave-value="{{ true }}"
>
    This element will be smoothly "faded" and removed in 1 second
</div>
```
