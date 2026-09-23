<?php

$isCli = (PHP_SAPI === 'cli');

$root = realpath(__DIR__ . '/../..');
if (!$root) {
    if ($isCli) {
        fwrite(STDERR, "Cannot resolve document root.\n");
    } else {
        http_response_code(500);
        echo 'Cannot resolve document root.';
    }
    exit(1);
}

$_SERVER['DOCUMENT_ROOT'] = $root;

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

use Bitrix\Main\Loader;

if (!$isCli) {
    global $USER;

    if (!is_object($USER) || !$USER->IsAuthorized() || !$USER->IsAdmin()) {
        http_response_code(403);
        echo '<!doctype html><html lang="ru"><head><meta charset="utf-8"><title>БЭСТ — миграция</title></head><body>';
        echo '<h1>Доступ запрещён</h1><p>Откройте страницу после авторизации администратором Bitrix.</p>';
        echo '</body></html>';
        exit;
    }
}

if (!Loader::includeModule('iblock')) {
    if ($isCli) {
        fwrite(STDERR, "Bitrix module 'iblock' is not available.\n");
    } else {
        http_response_code(500);
        echo 'Bitrix module "iblock" is not available.';
    }
    exit(1);
}

$apply = $isCli
    ? in_array('--apply', $argv, true)
    : ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['mode'] ?? '') === 'apply');

if (!$isCli && $apply && !check_bitrix_sessid()) {
    http_response_code(403);
    echo 'Invalid Bitrix session.';
    exit;
}

if (!$isCli) {
    ?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>БЭСТ — миграция контентной платформы</title>
        <style>
            body{font-family:Arial,sans-serif;max-width:1100px;margin:40px auto;padding:0 20px;color:#222}
            h1{margin-bottom:8px}.muted{color:#666}
            .panel{border:1px solid #ddd;padding:20px;margin:24px 0;background:#fafafa}
            .warning{border-left:4px solid #d8a100;padding:12px 16px;background:#fff8df;margin:18px 0}
            button{padding:10px 18px;border:0;background:#222;color:#fff;cursor:pointer;font-size:15px}
            a.button{display:inline-block;padding:10px 18px;border:1px solid #222;color:#222;text-decoration:none;margin-right:10px}
            pre{background:#111;color:#eee;padding:18px;overflow:auto;line-height:1.45;white-space:pre-wrap}
            .apply{background:#8a1f11}
        </style>
    </head>
    <body>
        <h1>БЭСТ — миграция контентной платформы</h1>
        <p class="muted">Скрипт создаёт только отсутствующие типы инфоблоков, инфоблоки, свойства и разделы.</p>

        <div class="warning">
            <strong>Режим APPLY меняет текущую базу данных Bitrix.</strong>
            Сначала выполните dry-run и проверьте список изменений.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Создать отсутствующие объекты в текущей БД?');">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="mode" value="apply">
                <button class="apply" type="submit">Apply migration</button>
            </form>
        </div>

        <h2>Результат</h2>
        <pre>
    <?php
}

function out(string $message): void
{
    global $isCli;

    if ($isCli) {
        fwrite(STDOUT, $message . PHP_EOL);
        return;
    }

    echo htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "\n";
}

function fail(string $message): void
{
    global $isCli;

    if ($isCli) {
        fwrite(STDERR, 'ERROR: ' . $message . PHP_EOL);
    } else {
        echo htmlspecialchars('ERROR: ' . $message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "\n";
        echo '</pre></body></html>';
    }

    exit(1);
}

function defaultSiteId(): string
{
    $by = 'sort';
    $order = 'asc';
    $res = CSite::GetList($by, $order, ['ACTIVE' => 'Y']);

    if ($row = $res->Fetch()) {
        return (string)$row['LID'];
    }

    return 's1';
}

function iblockTypeExists(string $id): bool
{
    return (bool)CIBlockType::GetByID($id)->Fetch();
}

function ensureIblockType(string $id, bool $apply): void
{
    if (iblockTypeExists($id)) {
        out('[ok] iblock type: ' . $id);
        return;
    }

    out('[new] iblock type: ' . $id);
    if (!$apply) {
        return;
    }

    $ob = new CIBlockType();
    $ok = $ob->Add([
        'ID' => $id,
        'SECTIONS' => 'Y',
        'IN_RSS' => 'N',
        'SORT' => 500,
        'LANG' => [
            'ru' => [
                'NAME' => 'БЭСТ: контент',
                'SECTION_NAME' => 'Разделы',
                'ELEMENT_NAME' => 'Элементы',
            ],
            'en' => [
                'NAME' => 'BEST: content',
                'SECTION_NAME' => 'Sections',
                'ELEMENT_NAME' => 'Elements',
            ],
        ],
    ]);

    if (!$ok) {
        fail($ob->LAST_ERROR ?: 'Cannot create iblock type.');
    }
}

function findIblock(string $code): ?array
{
    $res = CIBlock::GetList(
        ['ID' => 'ASC'],
        ['CODE' => $code, 'CHECK_PERMISSIONS' => 'N']
    );

    $row = $res->Fetch();
    return $row ?: null;
}

function ensureIblock(array $definition, bool $apply, string $siteId): ?int
{
    $existing = findIblock($definition['CODE']);

    if ($existing) {
        out(sprintf('[ok] iblock: %s (#%d)', $definition['CODE'], $existing['ID']));
        return (int)$existing['ID'];
    }

    out('[new] iblock: ' . $definition['CODE']);
    if (!$apply) {
        return null;
    }

    $ib = new CIBlock();
    $id = $ib->Add([
        'ACTIVE' => 'Y',
        'NAME' => $definition['NAME'],
        'CODE' => $definition['CODE'],
        'IBLOCK_TYPE_ID' => 'best_content',
        'SITE_ID' => [$siteId],
        'SORT' => $definition['SORT'],
        'VERSION' => 2,
        'LIST_PAGE_URL' => $definition['LIST_PAGE_URL'] ?? '',
        'SECTION_PAGE_URL' => $definition['SECTION_PAGE_URL'] ?? '',
        'DETAIL_PAGE_URL' => $definition['DETAIL_PAGE_URL'] ?? '',
        'GROUP_ID' => [
            2 => 'R',
        ],
    ]);

    if (!$id) {
        fail($ib->LAST_ERROR ?: 'Cannot create iblock ' . $definition['CODE']);
    }

    return (int)$id;
}

function findProperty(int $iblockId, string $code): ?array
{
    $res = CIBlockProperty::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code]
    );

    $row = $res->Fetch();
    return $row ?: null;
}

function ensureProperty(int $iblockId, array $definition, bool $apply): void
{
    $existing = findProperty($iblockId, $definition['CODE']);

    if ($existing) {
        out(sprintf('  [ok] property: %s (#%d)', $definition['CODE'], $existing['ID']));
        return;
    }

    out('  [new] property: ' . $definition['CODE']);
    if (!$apply) {
        return;
    }

    $property = new CIBlockProperty();

    $fields = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'NAME' => $definition['NAME'],
        'CODE' => $definition['CODE'],
        'PROPERTY_TYPE' => $definition['PROPERTY_TYPE'] ?? 'S',
        'MULTIPLE' => $definition['MULTIPLE'] ?? 'N',
        'SORT' => $definition['SORT'] ?? 500,
        'IS_REQUIRED' => $definition['IS_REQUIRED'] ?? 'N',
        'WITH_DESCRIPTION' => $definition['WITH_DESCRIPTION'] ?? 'N',
    ];

    foreach (['LINK_IBLOCK_ID', 'FILE_TYPE', 'ROW_COUNT', 'COL_COUNT'] as $key) {
        if (array_key_exists($key, $definition)) {
            $fields[$key] = $definition[$key];
        }
    }

    if (!empty($definition['VALUES'])) {
        $fields['VALUES'] = $definition['VALUES'];
    }

    $id = $property->Add($fields);

    if (!$id) {
        fail($property->LAST_ERROR ?: 'Cannot create property ' . $definition['CODE']);
    }
}

function ensureSection(int $iblockId, string $name, string $code, int $sort, bool $apply): void
{
    $res = CIBlockSection::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['ID']
    );

    if ($row = $res->Fetch()) {
        out(sprintf('[ok] section: %s (#%d)', $code, $row['ID']));
        return;
    }

    out('[new] section: ' . $code);
    if (!$apply) {
        return;
    }

    $section = new CIBlockSection();
    $id = $section->Add([
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'NAME' => $name,
        'CODE' => $code,
        'SORT' => $sort,
    ]);

    if (!$id) {
        fail($section->LAST_ERROR ?: 'Cannot create section ' . $code);
    }
}

$definitions = [
    'best_services' => [
        'NAME' => 'БЭСТ: услуги',
        'CODE' => 'best_services',
        'SORT' => 100,
        'LIST_PAGE_URL' => '/services/',
        'SECTION_PAGE_URL' => '/services/#SECTION_CODE#/',
        'DETAIL_PAGE_URL' => '/services/#SECTION_CODE#/#ELEMENT_CODE#/',
    ],
    'best_service_blocks' => [
        'NAME' => 'БЭСТ: блоки страниц услуг',
        'CODE' => 'best_service_blocks',
        'SORT' => 200,
    ],
    'best_documents' => [
        'NAME' => 'БЭСТ: документы и аккредитации',
        'CODE' => 'best_documents',
        'SORT' => 300,
    ],
    'best_news' => [
        'NAME' => 'БЭСТ: новости',
        'CODE' => 'best_news',
        'SORT' => 400,
        'LIST_PAGE_URL' => '/news/',
        'DETAIL_PAGE_URL' => '/news/#ELEMENT_CODE#/',
    ],
];

$serviceProperties = [
    ['NAME' => 'Подзаголовок первого экрана', 'CODE' => 'HERO_SUBTITLE', 'PROPERTY_TYPE' => 'S', 'SORT' => 100, 'ROW_COUNT' => 3],
    ['NAME' => 'SEO Title', 'CODE' => 'SEO_TITLE', 'PROPERTY_TYPE' => 'S', 'SORT' => 110],
    ['NAME' => 'SEO Description', 'CODE' => 'SEO_DESCRIPTION', 'PROPERTY_TYPE' => 'S', 'SORT' => 120, 'ROW_COUNT' => 3],
    ['NAME' => 'OpenGraph Title', 'CODE' => 'OG_TITLE', 'PROPERTY_TYPE' => 'S', 'SORT' => 130],
    ['NAME' => 'OpenGraph Description', 'CODE' => 'OG_DESCRIPTION', 'PROPERTY_TYPE' => 'S', 'SORT' => 140, 'ROW_COUNT' => 3],
    ['NAME' => 'Иконка списка', 'CODE' => 'ICON', 'PROPERTY_TYPE' => 'S', 'SORT' => 150],
];

$blockTypes = [
    ['VALUE' => 'Профиль / смысловой блок', 'DEF' => 'Y', 'SORT' => 100, 'XML_ID' => 'profile'],
    ['VALUE' => 'Карточки', 'DEF' => 'N', 'SORT' => 200, 'XML_ID' => 'cards'],
    ['VALUE' => 'Список', 'DEF' => 'N', 'SORT' => 300, 'XML_ID' => 'list'],
    ['VALUE' => 'FAQ', 'DEF' => 'N', 'SORT' => 400, 'XML_ID' => 'faq'],
    ['VALUE' => 'Типовые вопросы', 'DEF' => 'N', 'SORT' => 500, 'XML_ID' => 'questions'],
    ['VALUE' => 'Сравнение', 'DEF' => 'N', 'SORT' => 600, 'XML_ID' => 'compare'],
    ['VALUE' => 'Документы', 'DEF' => 'N', 'SORT' => 700, 'XML_ID' => 'documents'],
    ['VALUE' => 'Профессиональный статус', 'DEF' => 'N', 'SORT' => 800, 'XML_ID' => 'status'],
    ['VALUE' => 'CTA', 'DEF' => 'N', 'SORT' => 900, 'XML_ID' => 'cta'],
];

$layouts = [
    ['VALUE' => '1 колонка', 'DEF' => 'Y', 'SORT' => 100, 'XML_ID' => '1'],
    ['VALUE' => '2 колонки', 'DEF' => 'N', 'SORT' => 200, 'XML_ID' => '2'],
    ['VALUE' => '3 колонки', 'DEF' => 'N', 'SORT' => 300, 'XML_ID' => '3'],
    ['VALUE' => '4 колонки', 'DEF' => 'N', 'SORT' => 400, 'XML_ID' => '4'],
];

$documentTypes = [
    ['VALUE' => 'ФЭСЭ', 'DEF' => 'N', 'SORT' => 100, 'XML_ID' => 'fese'],
    ['VALUE' => 'СРО / НОПРИЗ', 'DEF' => 'N', 'SORT' => 200, 'XML_ID' => 'sro'],
    ['VALUE' => 'AudaPad Web', 'DEF' => 'N', 'SORT' => 300, 'XML_ID' => 'audatex'],
    ['VALUE' => 'Буклет', 'DEF' => 'N', 'SORT' => 400, 'XML_ID' => 'booklet'],
    ['VALUE' => 'Прочее', 'DEF' => 'Y', 'SORT' => 900, 'XML_ID' => 'other'],
];

$documentProperties = [
    ['NAME' => 'Тип документа', 'CODE' => 'DOC_TYPE', 'PROPERTY_TYPE' => 'L', 'VALUES' => $documentTypes, 'SORT' => 100, 'IS_REQUIRED' => 'Y'],
    ['NAME' => 'Номер', 'CODE' => 'NUMBER', 'PROPERTY_TYPE' => 'S', 'SORT' => 110],
    ['NAME' => 'Организация / правообладатель', 'CODE' => 'ISSUER', 'PROPERTY_TYPE' => 'S', 'SORT' => 120],
    ['NAME' => 'Дата выдачи', 'CODE' => 'ISSUE_DATE', 'PROPERTY_TYPE' => 'S', 'SORT' => 130],
    ['NAME' => 'Действует с', 'CODE' => 'VALID_FROM', 'PROPERTY_TYPE' => 'S', 'SORT' => 140],
    ['NAME' => 'Действует до', 'CODE' => 'VALID_TO', 'PROPERTY_TYPE' => 'S', 'SORT' => 150],
    ['NAME' => 'PDF / файл', 'CODE' => 'FILE', 'PROPERTY_TYPE' => 'F', 'FILE_TYPE' => 'pdf,doc,docx,jpg,jpeg,png,webp', 'SORT' => 160],
    ['NAME' => 'Ссылка на официальный реестр', 'CODE' => 'EXTERNAL_URL', 'PROPERTY_TYPE' => 'S', 'SORT' => 170],
];

$siteId = defaultSiteId();

out('BEST content platform migration');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('Site: ' . $siteId);
out('');

ensureIblockType('best_content', $apply);

$ids = [];
foreach ($definitions as $key => $definition) {
    $ids[$key] = ensureIblock($definition, $apply, $siteId);
}

$serviceId = $ids['best_services'] ? (int)$ids['best_services'] : null;
$blocksId = $ids['best_service_blocks'] ? (int)$ids['best_service_blocks'] : null;
$documentsId = $ids['best_documents'] ? (int)$ids['best_documents'] : null;

if ($serviceId) {
    ensureSection($serviceId, 'Судебные экспертизы', 'sudebnye-ekspertizy', 100, $apply);
    foreach ($serviceProperties as $property) {
        ensureProperty($serviceId, $property, $apply);
    }
} else {
    out('[new] section: sudebnye-ekspertizy');
    foreach ($serviceProperties as $property) {
        out('  [new] property: ' . $property['CODE']);
    }
}

$blockProperties = [
    ['NAME' => 'Услуга', 'CODE' => 'SERVICE', 'PROPERTY_TYPE' => 'E', 'LINK_IBLOCK_ID' => $serviceId ?: 0, 'SORT' => 100, 'IS_REQUIRED' => 'Y'],
    ['NAME' => 'Тип блока', 'CODE' => 'BLOCK_TYPE', 'PROPERTY_TYPE' => 'L', 'VALUES' => $blockTypes, 'SORT' => 110, 'IS_REQUIRED' => 'Y'],
    ['NAME' => 'Надзаголовок', 'CODE' => 'EYEBROW', 'PROPERTY_TYPE' => 'S', 'SORT' => 120],
    ['NAME' => 'Вводный текст', 'CODE' => 'INTRO', 'PROPERTY_TYPE' => 'S', 'SORT' => 130, 'ROW_COUNT' => 5],
    ['NAME' => 'Элементы блока', 'CODE' => 'ITEMS', 'PROPERTY_TYPE' => 'S', 'MULTIPLE' => 'Y', 'WITH_DESCRIPTION' => 'Y', 'SORT' => 140, 'ROW_COUNT' => 3],
    ['NAME' => 'Количество колонок', 'CODE' => 'LAYOUT', 'PROPERTY_TYPE' => 'L', 'VALUES' => $layouts, 'SORT' => 150],
    ['NAME' => 'Документы', 'CODE' => 'DOCUMENTS', 'PROPERTY_TYPE' => 'E', 'LINK_IBLOCK_ID' => $documentsId ?: 0, 'MULTIPLE' => 'Y', 'SORT' => 160],
    ['NAME' => 'Якорь', 'CODE' => 'ANCHOR', 'PROPERTY_TYPE' => 'S', 'SORT' => 170],
    ['NAME' => 'Текст кнопки', 'CODE' => 'CTA_LABEL', 'PROPERTY_TYPE' => 'S', 'SORT' => 180],
    ['NAME' => 'Ссылка кнопки', 'CODE' => 'CTA_URL', 'PROPERTY_TYPE' => 'S', 'SORT' => 190],
];

if ($blocksId) {
    foreach ($blockProperties as $property) {
        ensureProperty($blocksId, $property, $apply);
    }
} else {
    foreach ($blockProperties as $property) {
        out('  [new] property: ' . $property['CODE']);
    }
}

if ($documentsId) {
    foreach ($documentProperties as $property) {
        ensureProperty($documentsId, $property, $apply);
    }
} else {
    foreach ($documentProperties as $property) {
        out('  [new] property: ' . $property['CODE']);
    }
}

out('');
if ($apply) {
    out('Migration completed successfully.');
} else {
    out($isCli
        ? 'Dry run finished. Re-run with --apply to create missing objects.'
        : 'Dry run finished. If the list is correct, click "Apply migration".'
    );
}

if (!$isCli) {
    echo '</pre></body></html>';
}
