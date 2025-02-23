import { Controller } from '@hotwired/stimulus'

/**
 * takes text from data-source="" attribute
 * or if undefined event.currentTarget.innerText
 */
class default_1 extends Controller {
    get highPrioritySource() {
        return this.element.dataset.source
    }

    copy(event) {
        let source = this.highPrioritySource
        if (undefined === source) {
            source = event.currentTarget.innerText
        }

        navigator.clipboard.writeText(source)

        this.dispatch('copied', { prefix: 'grinway', bubbles: true })
    }
}

default_1.values = {}
default_1.targets = []

export { default_1 as default }
