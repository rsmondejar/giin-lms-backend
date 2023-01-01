import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import popper from 'popper.js'
import jQuery from 'jquery'
import 'bootstrap';
// import "jquery-ui/dist/jquery-ui";
import 'jquery-ui/ui/widgets/datepicker';
import 'bootstrap-duallistbox/src/jquery.bootstrap-duallistbox';
import flatpickr from 'flatpickr';
import { Spanish } from 'flatpickr/dist/l10n/es.js'


try {
    window.Popper = popper.default;
    window.$ = window.jQuery = jQuery;
    window.flatpickr = flatpickr;
    window.flatpickr.localize(Spanish);
} catch (error) {
    console.error(error);
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
