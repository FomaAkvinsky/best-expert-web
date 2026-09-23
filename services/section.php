<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'best:service.section',
    '',
    [
        'IBLOCK_CODE' => 'best_services',
        'CODE' => (string)($_GET['CODE'] ?? ''),
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => 3600,
    ]
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
