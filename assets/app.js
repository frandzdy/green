import './bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'toastr/build/toastr.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import 'bs-brain/tutorials/timelines/timeline-4/assets/css/timeline-4.css'

import '@popperjs/core';
import 'bootstrap';

import $ from 'jquery';
// things on "window" become global variables
window.$ = $;

import toastr from 'toastr';

toastr.options.preventDuplicates = true;
toastr.options.positionClass = 'toast-top-center';

window.toastr = toastr
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document.addEventListener('DOMContentLoaded', function() {
    const script = document.createElement('script');
    script.src = 'https://assets.calendly.com/assets/external/widget.js';
    script.type = 'text/javascript';
    script.defer = true;
    script.async = true;
    script.preload = true;
    script.as = 'script';
    document.head.appendChild(script);
});
