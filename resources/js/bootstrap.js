window._ = require('lodash');
import jQuery from 'jquery';
import Dropzone from 'dropzone';

// import autosize from 'autosize';
import 'bootstrap';
import 'datatables.net-bs4';
import 'popper.js';
import 'moment';
import moment from 'moment';
import 'select2';
/*import 'magnific-popup';
import 'jquery.appear';
import 'flatpickr';
import 'jquery-scroll-lock';
import 'jquery-ui/ui/widgets/sortable';
import 'bootstrap-notify';*/
import Swal from 'sweetalert2';
//import 'summernote';
import { success, dzUploadError } from './components';

// ..and assign to window the ones that need it
window.$ = jQuery;
window.jQuery = jQuery;
// window.Handlebars = Handlebars;
// window.autosize = autosize;
// window.Handlebars = Handlebars;
window.Swal = Swal;
// window.SimpleBar = SimpleBar;
window.Dropzone = Dropzone;
// window.Cookies = Cookies;
window.moment = moment;
window.success = success;
window.dzUploadError = dzUploadError;
window.CKEDITOR_BASEPATH = '/js/plugins/ckeditor4/';
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
