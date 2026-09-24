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
        <title>БЭСТ — строительно-техническая экспертиза</title>
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
        <h1>Строительно-техническая экспертиза</h1>
        <p class="muted">Синхронизирует существующую услугу service-construction и её блоки в best_service_blocks.</p>

        <div class="warning">
            <strong>APPLY меняет общую DEV/PROD Bitrix DB.</strong>
            Код страницы включается только после создания всех блоков.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Синхронизировать страницу строительно-технической экспертизы?');">
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

function sectionId(int $iblockId, string $code, ?int $parentId = null): int
{
    $filter = ['IBLOCK_ID' => $iblockId, 'CODE' => $code];

    if ($parentId !== null) {
        $filter['SECTION_ID'] = $parentId;
    }

    $res = CIBlockSection::GetList(
        ['ID' => 'ASC'],
        $filter,
        false,
        ['ID']
    );

    if ($row = $res->Fetch()) {
        return (int)$row['ID'];
    }

    fail('Section not found: ' . $code);
}

function elementByXmlId(int $iblockId, string $xmlId): ?array
{
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'XML_ID' => $xmlId],
        false,
        ['nTopCount' => 1],
        ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'XML_ID']
    );

    return $res->Fetch() ?: null;
}

function elementByCode(int $iblockId, string $code): ?array
{
    $res = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['nTopCount' => 1],
        ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'XML_ID']
    );

    return $res->Fetch() ?: null;
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

function documentIdByCode(int $iblockId, string $code): int
{
    $element = elementByCode($iblockId, $code);

    if (!$element) {
        fail('Document not found: ' . $code . '. Run content-platform-seed-documents.php first.');
    }

    return (int)$element['ID'];
}

function describedItems(array $pairs): array
{
    $result = [];

    foreach ($pairs as $pair) {
        $result[] = [
            'VALUE' => (string)$pair[0],
            'DESCRIPTION' => (string)($pair[1] ?? ''),
        ];
    }

    return $result;
}

function syncBlock(
    int $iblockId,
    int $serviceId,
    array $definition,
    array $blockTypes,
    array $layouts,
    array $views,
    bool $apply
): void {
    $existing = elementByCode($iblockId, $definition['code']);
    out(sprintf(
        '[%s] block: %s%s',
        $existing ? 'sync' : 'new',
        $definition['code'],
        $existing ? ' (#' . $existing['ID'] . ')' : ''
    ));

    if (!$apply) {
        return;
    }

    $properties = [
        'SERVICE' => $serviceId,
        'BLOCK_TYPE' => $blockTypes[$definition['type']],
        'EYEBROW' => $definition['eyebrow'] ?? '',
        'INTRO' => $definition['intro'] ?? '',
        'ITEMS' => !empty($definition['items']) ? describedItems($definition['items']) : [],
        'ITEM_ICONS' => $definition['icons'] ?? [],
        'SUBTITLE' => $definition['subtitle'] ?? '',
        'SUBINTRO' => $definition['subintro'] ?? '',
        'ANCHOR' => $definition['anchor'] ?? '',
        'CTA_LABEL' => $definition['cta_label'] ?? '',
        'CTA_URL' => $definition['cta_url'] ?? '',
        'DOCUMENTS' => $definition['documents'] ?? [],
    ];

    if (!empty($definition['layout'])) {
        $properties['LAYOUT'] = $layouts[$definition['layout']];
    }

    if (!empty($definition['view'])) {
        $properties['VIEW'] = $views[$definition['view']];
    }

    $fields = [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'SORT' => $definition['sort'],
        'NAME' => $definition['name'],
        'CODE' => $definition['code'],
        'DETAIL_TEXT' => $definition['detail'] ?? '',
        'DETAIL_TEXT_TYPE' => 'html',
    ];

    $element = new CIBlockElement();

    if ($existing) {
        if (!$element->Update((int)$existing['ID'], $fields)) {
            fail($element->LAST_ERROR ?: 'Cannot update block: ' . $definition['code']);
        }
        $id = (int)$existing['ID'];
    } else {
        $id = (int)$element->Add($fields);
        if (!$id) {
            fail($element->LAST_ERROR ?: 'Cannot create block: ' . $definition['code']);
        }
    }

    CIBlockElement::SetPropertyValuesEx($id, $iblockId, $properties);
}

$servicesIblockId = iblockId('best_services');
$blocksIblockId = iblockId('best_service_blocks');
$documentsIblockId = iblockId('best_documents');

$rootSectionId = sectionId($servicesIblockId, 'sudebnye-ekspertizy', 0);
$technicalSectionId = sectionId($servicesIblockId, 'technical', $rootSectionId);

out('BEST construction service seed');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

$service = elementByXmlId($servicesIblockId, 'service-construction');
if (!$service) {
    fail('Service with XML_ID service-construction not found. Run content-platform-seed-services.php first.');
}

$serviceId = (int)$service['ID'];
out(sprintf('[sync] service-construction (#%d) -> stroitelno-tehnicheskaya-ekspertiza', $serviceId));

if ($apply) {
    $element = new CIBlockElement();

    if (!$element->Update($serviceId, [
        'ACTIVE' => 'Y',
        'SORT' => 200,
        'NAME' => 'Строительно-техническая экспертиза',
        'CODE' => 'stroitelno-tehnicheskaya-ekspertiza',
        'XML_ID' => 'service-construction',
        'PREVIEW_TEXT' => 'Качество и объем работ, дефекты, причины повреждений, техническое состояние объекта, проектная и исполнительная документация.',
        'PREVIEW_TEXT_TYPE' => 'text',
    ])) {
        fail($element->LAST_ERROR ?: 'Cannot update construction service.');
    }

    CIBlockElement::SetPropertyValuesEx($serviceId, $servicesIblockId, [
        'HERO_SUBTITLE' => 'Экспертное исследование качества, объема и стоимости строительных работ, технического состояния объектов и причин возникновения дефектов — с документально и инструментально подтвержденными выводами.',
        'SEO_TITLE' => 'Строительно-техническая экспертиза для суда в Москве | БЭСТ',
        'SEO_DESCRIPTION' => 'Судебная и досудебная строительно-техническая экспертиза. Исследование качества, объема и стоимости строительных работ, дефектов, технического состояния объектов, проектной и исполнительной документации. ООО «БЭСТ».',
        'OG_TITLE' => 'Строительно-техническая экспертиза | БЭСТ',
        'OG_DESCRIPTION' => 'Исследование качества, объема и стоимости строительных работ, технического состояния объектов, дефектов и строительной документации.',
        'ICON' => 'linearicons-hammer-wrench',
    ]);

    CIBlockElement::SetElementSection($serviceId, [$rootSectionId, $technicalSectionId]);
}

$blockTypes = [
    'profile' => enumId($blocksIblockId, 'BLOCK_TYPE', 'profile'),
    'cards' => enumId($blocksIblockId, 'BLOCK_TYPE', 'cards'),
    'faq' => enumId($blocksIblockId, 'BLOCK_TYPE', 'faq'),
    'questions' => enumId($blocksIblockId, 'BLOCK_TYPE', 'questions'),
    'status' => enumId($blocksIblockId, 'BLOCK_TYPE', 'status'),
    'cta' => enumId($blocksIblockId, 'BLOCK_TYPE', 'cta'),
];

$layouts = [
    '1' => enumId($blocksIblockId, 'LAYOUT', '1'),
    '2' => enumId($blocksIblockId, 'LAYOUT', '2'),
    '3' => enumId($blocksIblockId, 'LAYOUT', '3'),
    '4' => enumId($blocksIblockId, 'LAYOUT', '4'),
];

$views = [
    'cards' => enumId($blocksIblockId, 'VIEW', 'cards'),
    'link-boxes-main' => enumId($blocksIblockId, 'VIEW', 'link-boxes-main'),
    'link-boxes-compact' => enumId($blocksIblockId, 'VIEW', 'link-boxes-compact'),
];

$feseDocumentId = documentIdByCode($documentsIblockId, 'fese-accreditation-053');
$sroDocumentId = documentIdByCode($documentsIblockId, 'sro-nopriz-membership');

$blocks = [
    [
        'code' => 'construction-intro',
        'sort' => 100,
        'name' => 'Строительно-техническое заключение должно быть проверяемым',
        'type' => 'profile',
        'intro' => 'Проводим судебные и досудебные строительно-технические исследования. Анализируем проектную, исполнительную и сметную документацию, исследуем объект, выполняем необходимые измерения и расчеты.',
        'detail' => '<p>Выводы заключения должны позволять установить, какие исходные данные использованы, каким методом проведено исследование и на чем основан ответ эксперта.</p>',
    ],
    [
        'code' => 'construction-tasks',
        'sort' => 200,
        'name' => 'Предмет и задачи исследования',
        'type' => 'cards',
        'eyebrow' => 'что мы делаем',
        'intro' => 'Строительно-техническая экспертиза выстраивается под конкретный предмет спора: от оценки качества отдельных работ до комплексного исследования объекта, документации, объемов и стоимости строительства.',
        'view' => 'link-boxes-main',
        'subtitle' => 'Основные направления исследования',
        'subintro' => 'Формат и состав работ определяются поставленными вопросами, объектом исследования и доступной документацией.',
        'items' => [
            ['Качество и дефекты строительных работ', 'Выявление недостатков, определение характера и причин их возникновения, оценка соответствия выполненных работ проекту и техническим требованиям.'],
            ['Объем и стоимость выполненных работ', 'Определение фактически выполненных объемов, проверка КС-2, КС-3, исполнительной и сметной документации, расчет стоимости работ.'],
            ['Техническое состояние объекта', 'Исследование конструкций, элементов зданий и сооружений, определение технического состояния, причин повреждений и необходимых восстановительных мероприятий.'],
        ],
        'icons' => [
            'linearicons-hammer-wrench',
            'linearicons-layers',
            'linearicons-apartment',
        ],
    ],
    [
        'code' => 'construction-methods',
        'sort' => 300,
        'name' => 'Методы исследования и техническая база',
        'type' => 'cards',
        'intro' => 'В зависимости от задачи применяем визуальный и инструментальный контроль, измерения, анализ проектной и исполнительной документации, расчетные и сметные методы.',
        'view' => 'link-boxes-compact',
        'items' => [
            ['Визуально-инструментальное обследование', 'Фиксация состояния конструкций и элементов объекта, выявление видимых дефектов, повреждений и отклонений.'],
            ['Геодезические и линейные измерения', 'Определение геометрических параметров, фактических размеров, отметок и отклонений в пределах поставленной задачи.'],
            ['Неразрушающий контроль конструкций', 'Исследование характеристик и состояния конструкций методами, не требующими их разрушения.'],
            ['Анализ проектной и исполнительной документации', 'Сопоставление проектных решений, рабочих материалов и исполнительных документов с фактическим состоянием объекта.'],
            ['Определение объемов выполненных работ', 'Проверка фактически выполненных объемов по объекту и их сопоставление с актами и иной документацией.'],
            ['Сметные и стоимостные расчеты', 'Проверка расчетов и определение стоимости выполненных либо восстановительных работ в рамках поставленных вопросов.'],
        ],
        'icons' => [
            'linearicons-eye',
            'linearicons-ruler',
            'linearicons-shield-check',
            'linearicons-file-search',
            'linearicons-layers',
            'linearicons-calculator',
        ],
        'detail' => '<p style="opacity:.75;">Конкретный состав методов и технических средств определяется объектом и вопросами эксперту. Модели приборов указываются только для фактически примененного оборудования.</p>',
    ],
    [
        'code' => 'construction-faq',
        'sort' => 400,
        'name' => 'Вопросы по строительно-технической экспертизе',
        'type' => 'faq',
        'intro' => 'Для предварительной оценки достаточно описать спор и направить основные материалы. Полный состав документов определяется после анализа задачи.',
        'items' => [
            ['Какие материалы нужны для начала?', 'Определение суда или описание спора, договор и техническое задание, проектная, рабочая, исполнительная и сметная документация — в зависимости от задачи.'],
            ['Можно ли провести экспертизу до обращения в суд?', 'Да. Досудебное исследование позволяет установить технические обстоятельства спора и определить целесообразность дальнейшего судебного разбирательства.'],
            ['Обязательно ли проводить осмотр объекта?', 'Зависит от поставленных вопросов и имеющихся материалов. Возможность исследования без осмотра определяется после предварительного анализа документов.'],
        ],
    ],
    [
        'code' => 'construction-questions-quality',
        'sort' => 500,
        'name' => 'Качество и соответствие работ',
        'type' => 'questions',
        'eyebrow' => 'практика',
        'subtitle' => 'Типовые вопросы строительно-технической экспертизы',
        'intro' => 'Типовые вопросы строительно-технической экспертизы. Конкретные формулировки зависят от предмета спора, объекта и состава материалов.',
        'items' => [
            ['Соответствуют ли выполненные работы проектной и рабочей документации?', ''],
            ['Имеются ли дефекты и недостатки?', ''],
            ['Каковы причины их возникновения?', ''],
            ['Являются ли выявленные недостатки устранимыми?', ''],
        ],
    ],
    [
        'code' => 'construction-questions-volume',
        'sort' => 510,
        'name' => 'Объем и стоимость работ',
        'type' => 'questions',
        'items' => [
            ['Каков фактический объем выполненных работ?', ''],
            ['Соответствуют ли фактические объемы сведениям в КС-2 и иной документации?', ''],
            ['Какова стоимость фактически выполненных работ?', ''],
            ['Какова стоимость устранения выявленных недостатков?', ''],
        ],
    ],
    [
        'code' => 'construction-questions-condition',
        'sort' => 520,
        'name' => 'Техническое состояние и причины повреждений',
        'type' => 'questions',
        'items' => [
            ['Каково техническое состояние конструкций или объекта?', ''],
            ['Каковы причины возникновения повреждений и дефектов?', ''],
            ['Возможна ли дальнейшая безопасная эксплуатация?', ''],
            ['Какие мероприятия необходимы для устранения выявленных нарушений?', ''],
        ],
    ],
    [
        'code' => 'construction-questions-docs',
        'sort' => 530,
        'name' => 'Проектная и исполнительная документация',
        'type' => 'questions',
        'items' => [
            ['Соответствуют ли выполненные работы проектным решениям?', ''],
            ['Имеются ли расхождения между фактически выполненными работами и исполнительной документацией?', ''],
            ['Каково техническое значение выявленных расхождений?', ''],
        ],
    ],
    [
        'code' => 'construction-help-questions',
        'sort' => 600,
        'name' => 'Помогаем сформулировать вопросы',
        'type' => 'profile',
        'intro' => 'До назначения судебной экспертизы специалисты БЭСТ могут изучить предмет спора и имеющиеся материалы и предложить технически корректные формулировки вопросов эксперту.',
        'detail' => '<p><a class="button button-primary" href="#b24-form">Направить материалы</a></p>',
    ],
    [
        'code' => 'construction-status',
        'sort' => 700,
        'name' => 'Профессиональный статус',
        'type' => 'status',
        'intro' => 'Строительно-технические исследования выполняются в контуре судебно-экспертной организации БЭСТ. Для строительного направления также показываем подтвержденный статус организации в области инженерных изысканий.',
        'documents' => [$feseDocumentId, $sroDocumentId],
    ],
    [
        'code' => 'construction-cta',
        'sort' => 800,
        'name' => 'Нужна строительно-техническая экспертиза для суда?',
        'type' => 'cta',
        'eyebrow' => 'оценка задачи',
        'intro' => 'Направьте определение суда, вопросы эксперту или краткое описание спора. Оценим состав необходимых исследований, материалы, сроки и стоимость проведения экспертизы.',
        'cta_label' => 'Оставить запрос',
        'cta_url' => '#b24-form',
    ],
];

foreach ($blocks as $block) {
    syncBlock(
        $blocksIblockId,
        $serviceId,
        $block,
        $blockTypes,
        $layouts,
        $views,
        $apply
    );
}

out('');
out($apply
    ? 'Construction service seed completed successfully. Public URL: /services/sudebnye-ekspertizy/stroitelno-tehnicheskaya-ekspertiza/'
    : 'Dry run finished. If the list is correct, click "Apply seed".'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
