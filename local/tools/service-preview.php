<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $USER, $APPLICATION;

if (!is_object($USER) || !$USER->IsAuthorized() || !$USER->IsAdmin()) {
    CHTTP::SetStatus('403 Forbidden');
    $APPLICATION->SetTitle('Доступ запрещен');
    echo '<section class="section section-lg"><div class="container"><p>Administrator authorization required.</p></div></section>';
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
    return;
}

$sectionCode = trim((string)($_GET['section'] ?? ''));
$xmlId = trim((string)($_GET['xml_id'] ?? ''));

$APPLICATION->IncludeComponent(
    'best:service.detail',
    '',
    [
        'IBLOCK_CODE' => 'best_services',
        'BLOCKS_IBLOCK_CODE' => 'best_service_blocks',
        'SECTION_CODE' => $sectionCode,
        'CODE' => '',
        'XML_ID' => $xmlId,
        'PREVIEW_MODE' => 'Y',
        'CACHE_TYPE' => 'N',
        'CACHE_TIME' => 0,
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
