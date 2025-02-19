import { Controller } from '@hotwired/stimulus'
import { useTransition } from './stimulus-use/useTransition.js'

/**
 *
 */
class default_1 extends Controller {

    #isUseTransitionInitialized = false
    #elementReadyToGetProcessed = true

    /**
     * Target getter
     */
    get _element() {
        return this.hasElementTarget ? this.elementTarget : this.element
    }

    connect() {
        // even when connect priority has element target
        this.elementTargetConnected(this._element)
    }

    elementTargetConnected(element) {
        if (this.#initUseTransition(element)) {
            this.#process(element)
        }
    }

    #initUseTransition(element) {
        if (true === this.#isUseTransitionInitialized) {
            return true
        }

        if (!element) {
            return false
        }

        useTransition(this, this.styleValue, {
            initShown: this.initShownValue,
            element,
            hiddenClass: this.hiddenClassValue,
        })

        this.#isUseTransitionInitialized = true

        return true
    }

    async #process(element) {
        if (true !== this.#elementReadyToGetProcessed) {
            return
        }
        this.#elementReadyToGetProcessed = false

        if (false === this.initShownValue) {
            setTimeout(() => {
                this.enter()
            }, 100)
        }

        if (true === this.willLeaveValue) {
            setTimeout(async () => {
                await this.leave()
                if (true === this.removeAfterLeaveValue) {
                    element?.remove()
                }
                this.#elementReadyToGetProcessed = true
            }, this.disappearInMsValue)
        } else {
            // put to stack
            setTimeout(() => this.#elementReadyToGetProcessed = true, 0)
        }
    }
}

default_1.values = {
    initShown: {
        type: Boolean,
        default: false,
    },
    willLeave: {
        type: Boolean,
        default: true,
    },
    removeAfterLeave: {
        type: Boolean,
        default: true,
    },
    style: {
        type: String,
        default: 'fade',
    },
    disappearInMs: {
        type: Number,
        default: 3000,
    },
    hiddenClass: {
        type: String,
        default: 'd-none',
    },
}

default_1.targets = [
    'element',
]

export { default_1 as default }
