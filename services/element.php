<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'best:service.detail',
    '',
    [
        'IBLOCK_CODE' => 'best_services',
        'BLOCKS_IBLOCK_CODE' => 'best_service_blocks',
        'SECTION_CODE' => (string)($_GET['SECTION_CODE'] ?? ''),
        'CODE' => (string)($_GET['CODE'] ?? ''),
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => 3600,
    ]
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
