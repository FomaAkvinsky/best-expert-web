<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Код инфоблока услуг',
            'TYPE' => 'STRING',
            'DEFAULT' => 'best_services',
        ],
        'SECTION_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Код раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
