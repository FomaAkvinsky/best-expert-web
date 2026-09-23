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
        <title>БЭСТ — наполнение каталога услуг</title>
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
        <h1>БЭСТ — наполнение каталога услуг</h1>
        <p class="muted">Создаёт группы и услуги для раздела «Судебные экспертизы». Пустой CODE означает отсутствие публичной детальной страницы.</p>

        <div class="warning">
            <strong>APPLY меняет текущую БД.</strong>
            Скрипт не перезаписывает уже заполненные тексты существующих элементов.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Создать недостающие разделы и услуги?');">
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

function sectionByCode(int $iblockId, string $code, ?int $parentId = null): ?array
{
    $filter = [
        'IBLOCK_ID' => $iblockId,
        'CODE' => $code,
    ];

    if ($parentId !== null) {
        $filter['SECTION_ID'] = $parentId;
    }

    $res = CIBlockSection::GetList(
        ['ID' => 'ASC'],
        $filter,
        false,
        ['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'CODE', 'DESCRIPTION', 'UF_*']
    );

    return $res->Fetch() ?: null;
}

function ensureChildSection(
    int $iblockId,
    int $parentId,
    array $definition,
    bool $apply
): ?int {
    $existing = sectionByCode($iblockId, $definition['CODE'], $parentId);

    if ($existing) {
        out(sprintf('[ok] section: %s (#%d)', $definition['CODE'], $existing['ID']));
        return (int)$existing['ID'];
    }

    out('[new] section: ' . $definition['CODE']);

    if (!$apply) {
        return null;
    }

    $section = new CIBlockSection();
    $id = $section->Add([
        'IBLOCK_ID' => $iblockId,
        'IBLOCK_SECTION_ID' => $parentId,
        'ACTIVE' => 'Y',
        'SORT' => $definition['SORT'],
        'NAME' => $definition['NAME'],
        'CODE' => $definition['CODE'],
        'DESCRIPTION' => $definition['DESCRIPTION'],
        'DESCRIPTION_TYPE' => 'text',
    ]);

    if (!$id) {
        fail($section->LAST_ERROR ?: 'Cannot create section ' . $definition['CODE']);
    }

    return (int)$id;
}

function elementByXmlId(int $iblockId, string $xmlId): ?array
{
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'XML_ID' => $xmlId],
        false,
        ['nTopCount' => 1],
        ['ID', 'IBLOCK_ID', 'XML_ID', 'NAME', 'CODE', 'PREVIEW_TEXT']
    );

    return $res->Fetch() ?: null;
}

function elementByCode(int $iblockId, string $code): ?array
{
    if ($code === '') {
        return null;
    }

    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['nTopCount' => 1],
        ['ID', 'IBLOCK_ID', 'XML_ID', 'NAME', 'CODE', 'PREVIEW_TEXT']
    );

    return $res->Fetch() ?: null;
}

function ensureService(
    int $iblockId,
    int $rootSectionId,
    int $groupSectionId,
    array $definition,
    bool $apply
): ?int {
    $existing = elementByXmlId($iblockId, $definition['XML_ID']);

    if (!$existing && $definition['CODE'] !== '') {
        $existing = elementByCode($iblockId, $definition['CODE']);
    }

    if ($existing) {
        out(sprintf(
            '[ok] service: %s (#%d)%s',
            $definition['XML_ID'],
            $existing['ID'],
            trim((string)$existing['CODE']) === '' ? ' [no public URL]' : ' [' . $existing['CODE'] . ']'
        ));

        if ($apply) {
            CIBlockElement::SetElementSection(
                (int)$existing['ID'],
                [$rootSectionId, $groupSectionId]
            );

            if (empty($existing['XML_ID'])) {
                $element = new CIBlockElement();
                $element->Update((int)$existing['ID'], ['XML_ID' => $definition['XML_ID']]);
            }
        }

        return (int)$existing['ID'];
    }

    out(sprintf(
        '[new] service: %s%s',
        $definition['XML_ID'],
        $definition['CODE'] === '' ? ' [no public URL]' : ' [' . $definition['CODE'] . ']'
    ));

    if (!$apply) {
        return null;
    }

    $element = new CIBlockElement();
    $id = $element->Add([
        'IBLOCK_ID' => $iblockId,
        'IBLOCK_SECTION_ID' => $rootSectionId,
        'ACTIVE' => 'Y',
        'SORT' => $definition['SORT'],
        'NAME' => $definition['NAME'],
        'CODE' => $definition['CODE'],
        'XML_ID' => $definition['XML_ID'],
        'PREVIEW_TEXT' => $definition['PREVIEW_TEXT'],
        'PREVIEW_TEXT_TYPE' => 'text',
    ]);

    if (!$id) {
        fail($element->LAST_ERROR ?: 'Cannot create service ' . $definition['XML_ID']);
    }

    CIBlockElement::SetPropertyValuesEx((int)$id, $iblockId, [
        'ICON' => $definition['ICON'],
    ]);

    CIBlockElement::SetElementSection(
        (int)$id,
        [$rootSectionId, $groupSectionId]
    );

    return (int)$id;
}

$iblockId = iblockId('best_services');
$rootSection = sectionByCode($iblockId, 'sudebnye-ekspertizy', 0);

if (!$rootSection) {
    fail('Root section sudebnye-ekspertizy not found.');
}

$rootSectionId = (int)$rootSection['ID'];

out('BEST services catalog seed');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

$rootFields = [
    'UF_HERO_SUBTITLE' => 'Экспертные исследования, подготовленные с учетом процессуальных требований, проверяемости методики и устойчивости выводов к оспариванию.',
    'UF_INTRO_TITLE' => 'Судебная экспертиза — это процесс',
    'UF_INTRO_TEXT' => "Мы выстраиваем управляемый экспертный результат: корректная постановка вопросов, исследование по методике, контроль логики и качества, заключение, пригодное для процессуальной оценки.\n\nЭто снижает риск оспаривания и повторных экспертиз и помогает держать спор под контролем.",
    'UF_LIST_EYEBROW' => 'направления',
    'UF_LIST_TITLE' => 'Виды судебных экспертиз',
    'UF_LIST_INTRO' => 'Подбираем формат под задачу и состав материалов — так, чтобы выводы были проверяемыми и устойчивыми в процессе.',
];

$missingRootFields = [];
foreach ($rootFields as $fieldName => $value) {
    if (trim((string)($rootSection[$fieldName] ?? '')) === '') {
        $missingRootFields[$fieldName] = $value;
    }
}

if ($missingRootFields) {
    foreach (array_keys($missingRootFields) as $fieldName) {
        out('[fill] root field: ' . $fieldName);
    }

    if ($apply) {
        $section = new CIBlockSection();

        if (!$section->Update($rootSectionId, $missingRootFields)) {
            fail($section->LAST_ERROR ?: 'Cannot fill root section fields.');
        }
    }
} else {
    out('[ok] root section copy');
}

$groups = [
    'technical' => [
        'NAME' => 'Технические экспертизы',
        'CODE' => 'technical',
        'SORT' => 100,
        'DESCRIPTION' => 'Исследования технического состояния, причин повреждений и качества выполненных работ — с фиксацией исходных данных, применяемых методик и диагностических протоколов.',
        'SERVICES' => [
            [
                'XML_ID' => 'service-auto',
                'NAME' => 'Автотехническая экспертиза',
                'CODE' => 'avtotehnicheskaya-ekspertiza',
                'SORT' => 100,
                'ICON' => 'linearicons-car2',
                'PREVIEW_TEXT' => 'Техническое состояние, причины неисправностей, качество ремонта, диагностика электронных систем, пробег и моточасы.',
            ],
            [
                'XML_ID' => 'service-construction',
                'NAME' => 'Строительно-техническая экспертиза',
                'CODE' => '',
                'SORT' => 200,
                'ICON' => 'linearicons-hammer-wrench',
                'PREVIEW_TEXT' => 'Качество и объем работ, дефекты, причины повреждений, соответствие проекту и нормативам.',
            ],
            [
                'XML_ID' => 'service-engineering',
                'NAME' => 'Инженерно-техническая экспертиза',
                'CODE' => '',
                'SORT' => 300,
                'ICON' => 'linearicons-factory',
                'PREVIEW_TEXT' => 'Исследование узлов, оборудования, механизмов, производственных систем и причин отказов.',
            ],
            [
                'XML_ID' => 'service-commodity',
                'NAME' => 'Товароведческая экспертиза',
                'CODE' => '',
                'SORT' => 400,
                'ICON' => 'linearicons-cart',
                'PREVIEW_TEXT' => 'Качество, комплектность, причины дефектов, соответствие характеристикам и условиям эксплуатации.',
            ],
        ],
    ],
    'economic' => [
        'NAME' => 'Экономические и оценочные экспертизы',
        'CODE' => 'economic',
        'SORT' => 200,
        'DESCRIPTION' => 'Финансовые расчеты, оценка стоимости и обоснование экономических показателей — в формате, пригодном для судебной оценки.',
        'SERVICES' => [
            [
                'XML_ID' => 'service-financial-economic',
                'NAME' => 'Финансово-экономическая экспертиза',
                'CODE' => '',
                'SORT' => 100,
                'ICON' => 'linearicons-chart-bars',
                'PREVIEW_TEXT' => 'Анализ финансовых показателей, расчет экономических параметров и проверка обоснованности доводов сторон.',
            ],
            [
                'XML_ID' => 'service-accounting',
                'NAME' => 'Бухгалтерская экспертиза',
                'CODE' => '',
                'SORT' => 200,
                'ICON' => 'linearicons-calculator',
                'PREVIEW_TEXT' => 'Проводки, первичные документы, корректность учета, взаиморасчеты, задолженности.',
            ],
            [
                'XML_ID' => 'service-valuation',
                'NAME' => 'Оценочная экспертиза',
                'CODE' => '',
                'SORT' => 300,
                'ICON' => 'linearicons-diamond2',
                'PREVIEW_TEXT' => 'Оценка стоимости активов, долей, имущества и прав — с учетом требований к отчетам и доказательствам.',
            ],
            [
                'XML_ID' => 'service-losses',
                'NAME' => 'Расчет убытков и упущенной выгоды',
                'CODE' => '',
                'SORT' => 400,
                'ICON' => 'linearicons-warning',
                'PREVIEW_TEXT' => 'Проверяемость формул, исходных данных и причинно-следственных связей — без оценочных допущений в воздухе.',
            ],
        ],
    ],
    'documents' => [
        'NAME' => 'Документальные экспертизы',
        'CODE' => 'documents',
        'SORT' => 300,
        'DESCRIPTION' => 'Когда документ — ключевое доказательство: исследуем подлинность, давность и признаки вмешательств, оформляя выводы в проверяемом виде.',
        'SERVICES' => [
            [
                'XML_ID' => 'service-handwriting',
                'NAME' => 'Почерковедческая экспертиза',
                'CODE' => '',
                'SORT' => 100,
                'ICON' => 'linearicons-pen2',
                'PREVIEW_TEXT' => 'Исследование подписей и рукописных записей, сравнение образцов, выводы о выполнителе.',
            ],
            [
                'XML_ID' => 'service-document-technical',
                'NAME' => 'Техническая экспертиза документов',
                'CODE' => '',
                'SORT' => 200,
                'ICON' => 'linearicons-file-search',
                'PREVIEW_TEXT' => 'Признаки подделки, внесения изменений, способы изготовления, печати и реквизиты.',
            ],
            [
                'XML_ID' => 'service-document-age',
                'NAME' => 'Определение давности документа',
                'CODE' => '',
                'SORT' => 300,
                'ICON' => 'linearicons-hourglass',
                'PREVIEW_TEXT' => 'Исследование времени нанесения реквизитов и последовательности выполнения записей и подписей.',
            ],
        ],
    ],
    'complex' => [
        'NAME' => 'Комплексные и проверочные форматы',
        'CODE' => 'complex',
        'SORT' => 400,
        'DESCRIPTION' => 'Когда один вид исследования не закрывает задачу, используем комплексный подход или проверяем уже подготовленные заключения.',
        'SERVICES' => [
            [
                'XML_ID' => 'service-complex',
                'NAME' => 'Комплексная экспертиза',
                'CODE' => '',
                'SORT' => 100,
                'ICON' => 'linearicons-puzzle',
                'PREVIEW_TEXT' => 'Несколько направлений исследования с единой логикой выводов и одним контуром ответственности.',
            ],
            [
                'XML_ID' => 'service-repeat',
                'NAME' => 'Повторная и дополнительная экспертиза',
                'CODE' => '',
                'SORT' => 200,
                'ICON' => 'linearicons-repeat',
                'PREVIEW_TEXT' => 'Когда требуется уточнение, расширение объема вопросов или проверка корректности ранее проведенного исследования.',
            ],
            [
                'XML_ID' => 'service-review',
                'NAME' => 'Рецензирование экспертных заключений',
                'CODE' => '',
                'SORT' => 300,
                'ICON' => 'linearicons-check',
                'PREVIEW_TEXT' => 'Анализ методики, полноты материалов и логики выводов для оценки уязвимостей и подготовки позиции.',
            ],
        ],
    ],
];

foreach ($groups as $group) {
    $groupSectionId = ensureChildSection(
        $iblockId,
        $rootSectionId,
        $group,
        $apply
    );

    if (!$groupSectionId && !$apply) {
        foreach ($group['SERVICES'] as $service) {
            out(sprintf(
                '  [new] service: %s%s',
                $service['XML_ID'],
                $service['CODE'] === '' ? ' [no public URL]' : ' [' . $service['CODE'] . ']'
            ));
        }
        continue;
    }

    foreach ($group['SERVICES'] as $service) {
        ensureService(
            $iblockId,
            $rootSectionId,
            (int)$groupSectionId,
            $service,
            $apply
        );
    }
}

out('');
out($apply
    ? 'Services catalog seed completed successfully.'
    : 'Dry run finished. If the list is correct, click "Apply seed".'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
