<?php

$isCli = (PHP_SAPI === 'cli');

$root = realpath(__DIR__ . '/../..');
if (!$root) {
    http_response_code(500);
    exit('Cannot resolve document root.');
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
        exit('Administrator authorization required.');
    }
}

if (!Loader::includeModule('iblock')) {
    http_response_code(500);
    exit('Bitrix module "iblock" is not available.');
}

$apply = $isCli
    ? in_array('--apply', $argv, true)
    : ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['mode'] ?? '') === 'apply');

if (!$isCli && $apply && !check_bitrix_sessid()) {
    http_response_code(403);
    exit('Invalid Bitrix session.');
}

if (!$isCli) {
    ?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>БЭСТ — обновление верстки автотехнической экспертизы</title>
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
        <h1>Обновление верстки автотехнической экспертизы</h1>
        <p class="muted">Добавляет существующим блокам режимы отображения, подзаголовки и иконки. Тексты блоков не перезаписываются.</p>

        <div class="warning">
            <strong>Сначала выполните content-platform-migrate.php.</strong>
            Новые свойства VIEW, SUBTITLE, SUBINTRO и ITEM_ICONS должны уже существовать.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Обновить параметры отображения блоков?');">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="mode" value="apply">
                <button class="apply" type="submit">Apply layout update</button>
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
    } else {
        echo htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "\n";
    }
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

function iblockId(string $code): int
{
    $res = CIBlock::GetList(['ID' => 'ASC'], ['CODE' => $code, 'CHECK_PERMISSIONS' => 'N']);

    if ($row = $res->Fetch()) {
        return (int)$row['ID'];
    }

    fail('IBlock not found: ' . $code);
}

function elementId(int $iblockId, string $code): int
{
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['nTopCount' => 1],
        ['ID']
    );

    if ($row = $res->Fetch()) {
        return (int)$row['ID'];
    }

    fail('Block not found: ' . $code);
}

function enumId(int $iblockId, string $propertyCode, string $xmlId): int
{
    $property = CIBlockProperty::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $propertyCode]
    )->Fetch();

    if (!$property) {
        fail('Property not found: ' . $propertyCode);
    }

    $res = CIBlockPropertyEnum::GetList(
        ['SORT' => 'ASC'],
        ['PROPERTY_ID' => (int)$property['ID'], 'XML_ID' => $xmlId]
    );

    if ($row = $res->Fetch()) {
        return (int)$row['ID'];
    }

    fail(sprintf('Enum not found: %s=%s', $propertyCode, $xmlId));
}

$iblockId = iblockId('best_service_blocks');

$views = [
    'link-boxes-main' => enumId($iblockId, 'VIEW', 'link-boxes-main'),
    'link-boxes-compact' => enumId($iblockId, 'VIEW', 'link-boxes-compact'),
];

$updates = [
    'auto-tasks' => [
        'VIEW' => $views['link-boxes-main'],
        'SUBTITLE' => 'Когда требуется автотехническая экспертиза',
        'SUBINTRO' => 'Чаще всего автотехническая экспертиза нужна, когда спор упирается в технические причины и достоверность данных автомобиля.',
        'ITEM_ICONS' => [
            'linearicons-wrench',
            'linearicons-cog',
            'linearicons-speed-fast',
        ],
    ],
    'auto-equipment' => [
        'VIEW' => $views['link-boxes-compact'],
        'ITEM_ICONS' => [
            'linearicons-ruler',
            'linearicons-eye',
            'linearicons-laptop-phone',
        ],
    ],
    'auto-brands' => [
        'VIEW' => $views['link-boxes-compact'],
        'ITEM_ICONS' => [
            'linearicons-cog',
            'linearicons-cog2',
            'linearicons-keyboard',
            'linearicons-layers',
            'linearicons-car',
        ],
    ],
    'auto-questions-condition' => [
        'SUBTITLE' => 'Типовые вопросы эксперту',
    ],
];

out('BEST automotive layout update');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

foreach ($updates as $code => $properties) {
    $id = elementId($iblockId, $code);
    out(sprintf('[update] %s (#%d)', $code, $id));

    if ($apply) {
        CIBlockElement::SetPropertyValuesEx($id, $iblockId, $properties);
    }
}

out('');
out($apply
    ? 'Automotive layout update completed successfully.'
    : 'Dry run finished. If the list is correct, click "Apply layout update".'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
