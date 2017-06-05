<?php
/**
 * api-google config file
 * @package api-google
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'api-google',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/api-google',
    '__files' => [
        'modules/api-google' => [
            'install',
            'remove',
            'update'
        ]
    ],
    '__dependencies' => [],
    '_services' => [
        'google' => 'ApiGoogle\\Service\\Google'
    ],
    '_autoload' => [
        'classes' => [
            'ApiGoogle\\Service\\Google' => 'modules/api-google/service/Google.php'
        ],
        'files' => []
    ]
];