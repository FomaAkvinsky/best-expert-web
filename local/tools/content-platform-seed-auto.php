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
        <title>БЭСТ — перенос автотехнической экспертизы</title>
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
        <h1>Перенос автотехнической экспертизы в инфоблоки</h1>
        <p class="muted">Seed создаёт элемент услуги и смысловые блоки только если их ещё нет.</p>

        <div class="warning">
            <strong>APPLY создаёт контент в текущей БД.</strong>
            Существующие элементы с теми же символьными кодами не перезаписываются.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Создать автотехническую экспертизу и её блоки?');">
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

function sectionId(int $iblockId, string $code): int
{
    $res = CIBlockSection::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
        false,
        ['ID']
    );

    if ($row = $res->Fetch()) {
        return (int)$row['ID'];
    }

    fail('Section not found: ' . $code);
}

function elementId(int $iblockId, string $code): ?int
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

    return null;
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

function createElement(
    int $iblockId,
    string $code,
    array $fields,
    array $properties,
    bool $apply
): ?int {
    $existingId = elementId($iblockId, $code);

    if ($existingId) {
        out(sprintf('[ok] %s (#%d)', $code, $existingId));
        return $existingId;
    }

    out('[new] ' . $code);

    if (!$apply) {
        return null;
    }

    $element = new CIBlockElement();
    $id = $element->Add(array_merge([
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        'CODE' => $code,
        'SORT' => 500,
    ], $fields));

    if (!$id) {
        fail($element->LAST_ERROR ?: 'Cannot create element: ' . $code);
    }

    if ($properties) {
        CIBlockElement::SetPropertyValuesEx((int)$id, $iblockId, $properties);
    }

    return (int)$id;
}

function describedItems(array $pairs): array
{
    $result = [];

    foreach ($pairs as $pair) {
        $result[] = [
            'VALUE' => (string)$pair[0],
            'DESCRIPTION' => (string)$pair[1],
        ];
    }

    return $result;
}

$servicesIblockId = iblockId('best_services');
$blocksIblockId = iblockId('best_service_blocks');
$sectionId = sectionId($servicesIblockId, 'sudebnye-ekspertizy');

out('BEST automotive service seed');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

$serviceCode = 'avtotehnicheskaya-ekspertiza';
$serviceId = elementId($servicesIblockId, $serviceCode);

if ($serviceId) {
    out(sprintf('[ok] %s (#%d)', $serviceCode, $serviceId));
} else {
    out('[new] ' . $serviceCode);

    if ($apply) {
        $element = new CIBlockElement();
        $serviceId = $element->Add([
            'IBLOCK_ID' => $servicesIblockId,
            'IBLOCK_SECTION_ID' => $sectionId,
            'ACTIVE' => 'Y',
            'NAME' => 'Автотехническая экспертиза',
            'CODE' => $serviceCode,
            'SORT' => 100,
            'PREVIEW_TEXT' => 'Техническое состояние, причины неисправностей, качество ремонта, диагностика электронных систем, пробег и моточасы.',
            'PREVIEW_TEXT_TYPE' => 'text',
        ]);

        if (!$serviceId) {
            fail($element->LAST_ERROR ?: 'Cannot create automotive service.');
        }

        CIBlockElement::SetPropertyValuesEx((int)$serviceId, $servicesIblockId, [
            'HERO_SUBTITLE' => 'Экспертное исследование технического состояния транспортного средства, причин неисправностей и качества ремонта — с фиксацией исходных данных и диагностическими протоколами.',
            'SEO_TITLE' => 'Автотехническая экспертиза БЭСТ | диагностика, пробег, причины неисправностей и качество ремонта',
            'SEO_DESCRIPTION' => 'Автотехническая экспертиза БЭСТ: техническое состояние авто, причины неисправностей и повреждений, качество ремонта, диагностика электронных блоков, определение пробега и моточасов. Фиксация исходных данных и процессуальная устойчивость выводов.',
            'OG_TITLE' => 'Автотехническая экспертиза БЭСТ — проверяемые выводы и диагностические протоколы',
            'OG_DESCRIPTION' => 'Осмотр кузова и агрегатов, компьютерная диагностика, проверка пробега и моточасов, оценка качества ремонта.',
            'ICON' => 'linearicons-car2',
        ]);
    }
}

$blockTypes = [
    'profile' => enumId($blocksIblockId, 'BLOCK_TYPE', 'profile'),
    'cards' => enumId($blocksIblockId, 'BLOCK_TYPE', 'cards'),
    'faq' => enumId($blocksIblockId, 'BLOCK_TYPE', 'faq'),
    'questions' => enumId($blocksIblockId, 'BLOCK_TYPE', 'questions'),
    'cta' => enumId($blocksIblockId, 'BLOCK_TYPE', 'cta'),
];

$layouts = [
    '1' => enumId($blocksIblockId, 'LAYOUT', '1'),
    '2' => enumId($blocksIblockId, 'LAYOUT', '2'),
];

$blocks = [
    [
        'code' => 'auto-intro',
        'sort' => 100,
        'name' => 'Автотехническое заключение должно быть проверяемым',
        'type' => 'profile',
        'intro' => 'Мы подготавливаем автотехнические заключения в досудебном и судебном порядке: фиксируем исходные данные, используем профессиональное оборудование и программные комплексы, а выводы формулируем так, чтобы они выдерживали процессуальную проверку.',
        'detail' => '<p>Важен не только результат диагностики, но и то, как он получен и оформлен: это снижает риск оспаривания и повторных экспертиз.</p>',
    ],
    [
        'code' => 'auto-tasks',
        'sort' => 200,
        'name' => 'Предмет и задачи исследования',
        'type' => 'cards',
        'eyebrow' => 'что мы делаем',
        'intro' => 'Экспертиза выстраивается под конкретную задачу: от осмотра кузова и агрегатов до компьютерного тестирования электронных блоков.',
        'layout' => '1',
        'items' => [
            ['Споры о причинах поломки', 'Определение характера неисправности, причин выхода из строя узлов и агрегатов, влияние эксплуатации и ремонта.'],
            ['Оценка качества ремонта', 'Проверка соответствия выполненных работ заявленному объему, выявление дефектов и причин повторных неисправностей.'],
            ['Достоверность пробега и данных ЭБУ', 'Диагностика электронных блоков, выявление несоответствий пробега, моточасов и следов вмешательств.'],
        ],
    ],
    [
        'code' => 'auto-equipment-intro',
        'sort' => 300,
        'name' => 'Оборудование и протоколы',
        'type' => 'profile',
        'intro' => 'Используем специализированные средства осмотра кузова и агрегатов, а также программные комплексы диагностики и тестирования ЭБУ по маркам. Это позволяет фиксировать данные в воспроизводимом виде.',
    ],
    [
        'code' => 'auto-equipment',
        'sort' => 400,
        'name' => 'Оборудование и программные комплексы',
        'type' => 'cards',
        'intro' => 'В рамках подготовки автотехнических заключений используем профессиональное оборудование для осмотра кузовных элементов, скрытых полостей, узлов и агрегатов, а также компьютерной диагностики с тестированием электронных блоков.',
        'layout' => '1',
        'items' => [
            ['Толщиномер Carsys ProPro', 'Осмотр кузовных элементов: определение типа металла, выявление следов окраса и наличия шпаклевки.'],
            ['Эндоскоп iCartool (360°)', 'Осмотр скрытых полостей кузова, узлов и агрегатов, в том числе оценка состояния стенок цилиндров и скрытых повреждений.'],
            ['Компьютерная диагностика и тестирование ЭБУ', 'Чтение параметров, проверка работоспособности электронных блоков, анализ данных пробега и моточасов — в зависимости от марки и модели.'],
        ],
    ],
    [
        'code' => 'auto-brands',
        'sort' => 500,
        'name' => 'Диагностика по маркам',
        'type' => 'cards',
        'intro' => 'Используем профильные программные комплексы и интерфейсы для диагностики и тестирования — когда важна максимальная точность данных.',
        'layout' => '1',
        'items' => [
            ['Volkswagen AG', 'Оригинальный адаптер VAS6154A с диагностическим интерфейсом и программным комплексом ODIS — в зависимости от задачи и поколения систем.'],
            ['BMW Group', 'Программный комплекс ISTA+ для диагностики и анализа параметров электронных систем.'],
            ['FORD', 'Программный комплекс ForScan с возможностью кодировки и изменения отдельных параметров при необходимости тестирования.'],
            ['Volvo, Land Rover, Opel, Subaru, Mitsubishi', 'Volvo — Vida Dice; Land Rover — SDD; Opel — Op-com или GDS2; Subaru — Select Monitor 4; Mitsubishi — MUT 2.'],
            ['Универсальная диагностика', 'Launch X-431 Pro 5 — диагностика различных автомобилей, мотоциклов и грузовой техники.'],
        ],
        'detail' => '<p style="opacity:.75;">На сайте представлен не полный перечень диагностируемых марок. Возможность осмотра и диагностики конкретного транспортного средства уточняйте у нас.</p>',
    ],
    [
        'code' => 'auto-faq',
        'sort' => 600,
        'name' => 'Вопросы по автотехнической экспертизе',
        'type' => 'faq',
        'intro' => 'Если вы сомневаетесь в формате исследования, начнем с оценки материалов: что есть в наличии, что нужно зафиксировать и какие вопросы корректно ставить для получения устойчивых выводов.',
        'items' => [
            ['Какие материалы нужны для начала?', 'Краткое описание ситуации, документы по ремонту или обслуживанию — если есть, фото и видео, перечень вопросов и данные автомобиля: VIN, модель, год.'],
            ['Можно ли провести экспертизу в досудебном порядке?', 'Да. Досудебное заключение помогает сформировать позицию, уточнить круг вопросов и подготовить материалы для суда — при необходимости.'],
            ['По всем ли маркам вы делаете диагностику?', 'По большинству распространенных марок — да. Перечень на сайте не полный, поэтому лучше уточнить возможность диагностики по конкретной модели.'],
        ],
    ],
    [
        'code' => 'auto-questions-condition',
        'sort' => 700,
        'name' => 'Техническое состояние и причины неисправности',
        'type' => 'questions',
        'eyebrow' => 'типовые вопросы эксперту',
        'intro' => 'Примеры формулировок для досудебного исследования и судебной автотехнической экспертизы. Конкретный перечень зависит от обстоятельств дела и имеющихся материалов.',
        'items' => [
            ['Каково техническое состояние транспортного средства или конкретного узла/агрегата на момент осмотра?', ''],
            ['Имеются ли неисправности или повреждения? Каков их характер и степень?', ''],
            ['Какова наиболее вероятная причина возникновения выявленной неисправности или повреждения?', ''],
            ['Связана ли неисправность с нарушением правил эксплуатации, перегревом, недостатком смазки, внешним воздействием или износом?', ''],
            ['Могли ли выявленные дефекты возникнуть в результате проведенных ремонтных работ или вмешательства в конструкцию?', ''],
        ],
    ],
    [
        'code' => 'auto-questions-repair',
        'sort' => 710,
        'name' => 'Ремонт и качество выполненных работ',
        'type' => 'questions',
        'items' => [
            ['Соответствует ли выполненный ремонт заявленному объему работ и требованиям производителя или технологии ремонта?', ''],
            ['Имеются ли признаки некачественного ремонта, несоблюдения технологии или использования неподходящих материалов или запчастей?', ''],
            ['Находится ли выявленная неисправность в причинно-следственной связи с выполненными работами или их отсутствием?', ''],
            ['Требуется ли повторный ремонт или замена узла? Каков объем необходимых работ для восстановления работоспособности?', ''],
            ['Могли ли работы или диагностика быть выполнены с нарушением требований, повлиявших на итоговый результат?', ''],
        ],
    ],
    [
        'code' => 'auto-questions-body',
        'sort' => 720,
        'name' => 'Кузов и следы вмешательств',
        'type' => 'questions',
        'items' => [
            ['Имеются ли на кузовных элементах признаки вторичной окраски или ремонта — перекрас, шпаклевка, локальные работы?', ''],
            ['Есть ли признаки скрытых повреждений кузова или силовых элементов, не заявленных при продаже или ремонте?', ''],
            ['Соответствуют ли обнаруженные следы ремонта заявленным обстоятельствам ДТП, страхового случая или ремонта у СТО?', ''],
            ['Имеются ли признаки механического вмешательства в элементы кузова или агрегаты, влияющего на безопасность или эксплуатацию?', ''],
        ],
    ],
    [
        'code' => 'auto-questions-electronics',
        'sort' => 730,
        'name' => 'Электронные блоки, пробег и диагностические данные',
        'type' => 'questions',
        'items' => [
            ['Соответствуют ли диагностические данные электронных блоков заявленным характеристикам автомобиля, включая пробег и моточасы?', ''],
            ['Имеются ли признаки корректировки пробега или вмешательства в электронные блоки управления?', ''],
            ['Согласуются ли показания пробега и моточасов в различных блоках между собой? Если нет — в чем выражаются расхождения?', ''],
            ['Имеются ли ошибки или события в памяти блоков, указывающие на характер неисправности или условия ее возникновения?', ''],
            ['Возможна ли проверка работоспособности отдельных электронных систем путем тестирования и какие результаты получены?', ''],
        ],
    ],
    [
        'code' => 'auto-help-questions',
        'sort' => 800,
        'name' => 'Помогаем сформулировать вопросы',
        'type' => 'profile',
        'intro' => 'Перед началом работы мы уточняем предмет доказывания и доступные материалы: документы по ремонту, акты, заказ-наряды, фото и видео, данные диагностик. После этого предлагаем корректные формулировки вопросов под вашу ситуацию — так, чтобы выводы были проверяемыми и пригодными для процессуальной оценки.',
    ],
    [
        'code' => 'auto-cta',
        'sort' => 900,
        'name' => 'Нужна автотехническая экспертиза под суд?',
        'type' => 'cta',
        'eyebrow' => 'оценка задачи',
        'intro' => 'Оставьте запрос — оценим материалы, уточним возможность диагностики по марке и предложим оптимальный формат работы.',
        'cta_label' => 'Оставить запрос',
        'cta_url' => '#b24-form',
    ],
];

if (!$serviceId && !$apply) {
    out('');
    out('Blocks below will be created after the service element.');
}

foreach ($blocks as $block) {
    $properties = [
        'BLOCK_TYPE' => $blockTypes[$block['type']],
    ];

    if ($serviceId) {
        $properties['SERVICE'] = (int)$serviceId;
    }

    if (!empty($block['eyebrow'])) {
        $properties['EYEBROW'] = $block['eyebrow'];
    }

    if (!empty($block['intro'])) {
        $properties['INTRO'] = $block['intro'];
    }

    if (!empty($block['items'])) {
        $properties['ITEMS'] = describedItems($block['items']);

        if (($block['type'] ?? '') === 'faq') {
            $properties['FAQ_ANSWERS'] = array_map(
                static fn($item) => (string)($item[1] ?? ''),
                $block['items']
            );
        }
    }

    if (!empty($block['layout'])) {
        $properties['LAYOUT'] = $layouts[$block['layout']];
    }

    if (!empty($block['cta_label'])) {
        $properties['CTA_LABEL'] = $block['cta_label'];
    }

    if (!empty($block['cta_url'])) {
        $properties['CTA_URL'] = $block['cta_url'];
    }

    $fields = [
        'NAME' => $block['name'],
        'SORT' => $block['sort'],
        'DETAIL_TEXT' => $block['detail'] ?? '',
        'DETAIL_TEXT_TYPE' => 'html',
    ];

    if (!$serviceId && $apply) {
        fail('Service ID is not available for block creation.');
    }

    createElement(
        $blocksIblockId,
        $block['code'],
        $fields,
        $properties,
        $apply
    );
}

out('');
out($apply
    ? 'Automotive service seed completed successfully.'
    : 'Dry run finished. If the list is correct, click "Apply seed".'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
