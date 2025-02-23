UX stimulus controllers
------

### `grinway--transition`

Description:

Applies css transition to smoothly show then smoothly hide, or it's initially shown smoothly hide element later

Optionally remove from the DOM

Usage:

```html
<!-- it's a twig template -->
<div
        <!-- stimulus controller -->
        data-controller="grinway--transition"
        
        <!-- Optional "element" target (what element you want to apply transition to?) -->
        <!-- Has priority over controller element -->
        <!-- If not passed controller element is used -->
        data-grinway--transition-target="element"

        <!-- Optional value -->
        data-grinway--transition-init-shown-value="{{ true }}"
        <!-- Optional value -->
        <!-- "fade", "slide", "flash", "rotate" (see "@grinway/web-app-bundle/dist/style/transition.css") -->
        data-grinway--transition-style-value="fade"
        <!-- Optional value -->
        data-grinway--transition-disappear-in-ms-value="1000"
        <!-- Optional value -->
        data-grinway--transition-will-leave-value="{{ true }}"
        <!-- Optional value -->
        data-grinway--transition-remove-after-leave-value="{{ true }}"
        <!-- Optional value -->
        data-grinway--transition-hidden-class-value="d-none"
>
    This element will be smoothly "faded" and removed in 1 second
</div>
```
