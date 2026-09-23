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
        'BLOCKS_IBLOCK_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Код инфоблока блоков',
            'TYPE' => 'STRING',
            'DEFAULT' => 'best_service_blocks',
        ],
        'CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Символьный код услуги',
            'TYPE' => 'STRING',
            'DEFAULT' => '={$_REQUEST["CODE"]}',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
