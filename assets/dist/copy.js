import { Controller } from '@hotwired/stimulus'

/**
 * takes text from data-source="" attribute
 * or if undefined event.currentTarget.innerText
 */
class Copy extends Controller {
    get highPrioritySource() {
        return '' === this.sourceValue ? this.element.dataset.source : this.sourceValue
    }

    copy(event) {
        let source = this.highPrioritySource
        if (undefined === source) {
            source = event.currentTarget.innerText
        }

        navigator.clipboard.writeText(source)

        this.dispatch('copied', {
            prefix: 'grinway', bubbles: true, detail: {
                copied: source,
            }
        })
    }
}

Copy.values = {
    source: {
        type: String,
        default: '',
    },
}
Copy.targets = []

export { Copy as default }
