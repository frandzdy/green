import './bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'toastr/build/toastr.min.css';
import 'jquery-confirm/css/jquery-confirm.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';

import '@popperjs/core';
import 'bootstrap';

import $ from 'jquery';
// things on "window" become global variables
window.$ = $;

import jconfirm from 'jquery-confirm';
jconfirm.defaults = {theme:'bootstrap'}

window.jconfirm = jconfirm

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

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', function() {
    const script = document.createElement('script');
    script.src = 'https://assets.calendly.com/assets/external/widget.js';
    script.type = 'text/javascript';
    document.head.appendChild(script);
});