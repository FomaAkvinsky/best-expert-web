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
        'CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Символьный код раздела',
            'TYPE' => 'STRING',
            'DEFAULT' => '={$_REQUEST["CODE"]}',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
