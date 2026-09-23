<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_CODE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Код инфоблока документов',
            'TYPE' => 'STRING',
            'DEFAULT' => 'best_documents',
        ],
        'DOC_TYPES' => [
            'PARENT' => 'BASE',
            'NAME' => 'XML_ID типов документов',
            'TYPE' => 'STRING',
            'MULTIPLE' => 'Y',
            'DEFAULT' => [],
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
    ],
];
