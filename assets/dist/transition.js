import { Controller } from '@hotwired/stimulus'
import { useTransition } from './stimulus-use/useTransition.js'

/**
 *
 */
class default_1 extends Controller {

    #isUseTransitionInitialized = false
    #isProcessEnabled = false

    /**
     * Target getter
     */
    get _element() {
        return this.hasElementTarget ? this.elementTarget : null
    }

    elementTargetConnected(element) {
        if (this.#initUseTransition()) {
            this.#isProcessEnabled = true
            this.#process()
        }
    }

    elementTargetDisconnected(element) {
        this.#isProcessEnabled = false
    }

    #initUseTransition() {
        if (true === this.#isUseTransitionInitialized) {
            return true
        }

        if (null === this._element) {
            return false
        }

        useTransition(this, this.styleValue, {
            initShown: this.initShownValue,
            element: this._element,
            hiddenClass: this.hiddenClassValue,
        })

        this.#isUseTransitionInitialized = true

        return true
    }

    async #process() {
        if (false === this.#isProcessEnabled) {
            return
        }

        if (false === this.initShownValue) {
            setTimeout(() => {
                this.enter()
            }, 100)
        }

        if (true === this.willLeaveValue) {
            setTimeout(async () => {
                await this.leave()
                if (true === this.removeAfterLeaveValue) {
                    this._element?.remove()
                }
            }, this.disappearInMsValue)
        }
    }
}

default_1.values = {
    initShown: {
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
    willLeave: {
        type: Boolean,
        default: true,
    },
    removeAfterLeave: {
        type: Boolean,
        default: true,
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
