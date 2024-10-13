<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    'back_app' => [
        'path' => './assets/js/back/back_app.js',
        'entrypoint' => true,
    ],
    'front_app' => [
        'path' => './assets/js/front/front_app.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.10',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'jquery-confirm' => [
        'version' => '3.3.4',
    ],
    'toastr' => [
        'version' => '2.1.4',
    ],
    'toastr/build/toastr.min.css' => [
        'version' => '2.1.4',
        'type' => 'css',
    ],
    'bootstrap-icons/font/bootstrap-icons.min.css' => [
        'version' => '1.11.3',
        'type' => 'css',
    ],
    'tom-select' => [
        'version' => '2.3.1',
    ],
    'tom-select/dist/css/tom-select.bootstrap5.css' => [
        'version' => '2.3.1',
        'type' => 'css',
    ],
    'bs-brain/tutorials/timelines/timeline-4/assets/css/timeline-4.css' => [
        'version' => '2.0.4',
        'type' => 'css',
    ],
    'jquery-confirm/css/jquery-confirm.min.css' => [
        'version' => '3.3.4',
        'type' => 'css',
    ],
];
