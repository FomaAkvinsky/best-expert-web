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
        <title>БЭСТ — документы и профессиональный статус</title>
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
        <h1>Документы и профессиональный статус БЭСТ</h1>
        <p class="muted">Создаёт записи ФЭСЭ, СРО/НОПРИЗ и AudaPad Web в инфоблоке документов.</p>

        <div class="warning">
            <strong>PDF-файлы скрипт не прикрепляет.</strong>
            После создания записей их можно загрузить в свойство FILE через административную часть Bitrix.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Создать записи документов?');">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="mode" value="apply">
                <button class="apply" type="submit">Apply seed</button>
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

function findElement(int $iblockId, string $code): ?array
{
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['nTopCount' => 1],
        ['ID', 'NAME', 'CODE']
    );

    return $res->Fetch() ?: null;
}

function ensureDocument(int $iblockId, array $definition, bool $apply): void
{
    $existing = findElement($iblockId, $definition['CODE']);

    if ($existing) {
        out(sprintf('[ok] %s (#%d)', $definition['CODE'], $existing['ID']));
        return;
    }

    out('[new] ' . $definition['CODE']);

    if (!$apply) {
        return;
    }

    $element = new CIBlockElement();
    $id = $element->Add([
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'SORT' => $definition['SORT'],
        'NAME' => $definition['NAME'],
        'CODE' => $definition['CODE'],
        'PREVIEW_TEXT' => $definition['PREVIEW_TEXT'],
        'PREVIEW_TEXT_TYPE' => 'html',
        'DETAIL_TEXT' => $definition['DETAIL_TEXT'],
        'DETAIL_TEXT_TYPE' => 'html',
    ]);

    if (!$id) {
        fail($element->LAST_ERROR ?: 'Cannot create document ' . $definition['CODE']);
    }

    CIBlockElement::SetPropertyValuesEx((int)$id, $iblockId, $definition['PROPERTIES']);
}

$iblockId = iblockId('best_documents');

$types = [
    'fese' => enumId($iblockId, 'DOC_TYPE', 'fese'),
    'sro' => enumId($iblockId, 'DOC_TYPE', 'sro'),
    'audatex' => enumId($iblockId, 'DOC_TYPE', 'audatex'),
];

$documents = [
    [
        'CODE' => 'fese-accreditation-053',
        'SORT' => 100,
        'NAME' => 'Аккредитация при Союзе ФЭСЭ',
        'PREVIEW_TEXT' => '<p><strong>Аккредитованная судебно-экспертная организация.</strong> ООО «БЭСТ» аккредитовано при Союзе финансово-экономических судебных экспертов и включено в реестр аккредитованных негосударственных судебно-экспертных организаций.</p>',
        'DETAIL_TEXT' => '<p>Свидетельство № 053 от 24 февраля 2026 года. ИНН 7734396380.</p>',
        'PROPERTIES' => [
            'DOC_TYPE' => $types['fese'],
            'NUMBER' => 'Свидетельство № 053',
            'ISSUER' => 'Союз финансово-экономических судебных экспертов',
            'ISSUE_DATE' => '24.02.2026',
        ],
    ],
    [
        'CODE' => 'sro-nopriz-membership',
        'SORT' => 200,
        'NAME' => 'Членство в СРО в области инженерных изысканий',
        'PREVIEW_TEXT' => '<p>ООО «БЭСТ» является членом Ассоциации «Национальное объединение изыскателей „Альянс Развитие“». Сведения об организации включены в Единый реестр НОПРИЗ.</p>',
        'DETAIL_TEXT' => '<p>Регистрационный номер члена СРО: <strong>И-046-007734396380-1421</strong>. Дата вступления: 18 сентября 2026 года.</p><p>Организация имеет право выполнять инженерные изыскания в отношении объектов капитального строительства, за исключением особо опасных, технически сложных и уникальных объектов и объектов использования атомной энергии. Уровень ответственности по компенсационному фонду возмещения вреда — первый; стоимость обязательств по одному договору не превышает 25 млн рублей.</p>',
        'PROPERTIES' => [
            'DOC_TYPE' => $types['sro'],
            'NUMBER' => 'И-046-007734396380-1421',
            'ISSUER' => 'Ассоциация «Национальное объединение изыскателей „Альянс Развитие“», СРО-И-046-23072019',
            'ISSUE_DATE' => '18.09.2026',
        ],
    ],
    [
        'CODE' => 'audapad-web-certificate-21811456-01',
        'SORT' => 300,
        'NAME' => 'Сертификат пользователя AudaPad Web',
        'PREVIEW_TEXT' => '<p>ООО «БЮРО ЭКСПЕРТНЫХ СИСТЕМ И ТЕХНОЛОГИЙ» является официальным пользователем программного продукта и базы данных AudaPad Web.</p>',
        'DETAIL_TEXT' => '<p>Идентификационный номер 444577. Сертификат подтверждает право использования AudaPad Web для составления ремонтных калькуляций на автомототранспортные средства.</p>',
        'PROPERTIES' => [
            'DOC_TYPE' => $types['audatex'],
            'NUMBER' => 'Сертификат № 21811456/01',
            'ISSUER' => 'ООО «Аудатэкс»',
            'VALID_FROM' => '21.09.2026',
            'VALID_TO' => '20.09.2027',
        ],
    ],
];

out('BEST documents seed');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

foreach ($documents as $document) {
    ensureDocument($iblockId, $document, $apply);
}

out('');
out($apply
    ? 'Documents seed completed successfully.'
    : 'Dry run finished. If the list is correct, click "Apply seed".'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
