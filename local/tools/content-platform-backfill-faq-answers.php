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
        <title>БЭСТ — заполнение полных ответов FAQ</title>
        <style>
            body{font-family:Arial,sans-serif;max-width:1100px;margin:40px auto;padding:0 20px;color:#222}
            h1{margin-bottom:8px}.muted{color:#666}
            .panel{border:1px solid #ddd;padding:20px;margin:24px 0;background:#fafafa}
            .safe{border-left:4px solid #2f8f46;padding:12px 16px;background:#effaf2;margin:18px 0}
            button{padding:10px 18px;border:0;background:#222;color:#fff;cursor:pointer;font-size:15px}
            a.button{display:inline-block;padding:10px 18px;border:1px solid #222;color:#222;text-decoration:none;margin-right:10px}
            pre{background:#111;color:#eee;padding:18px;overflow:auto;line-height:1.45;white-space:pre-wrap}
            .apply{background:#176b2b}
        </style>
    </head>
    <body>
        <h1>Полные ответы FAQ</h1>
        <p class="muted">Заполняет только свойство FAQ_ANSWERS у существующих FAQ-блоков.</p>

        <div class="safe">
            <strong>Безопасный backfill.</strong>
            SORT, стили, названия, INTRO, DETAIL_TEXT, ITEMS, связи и любые другие свойства не изменяются.
        </div>

        <div class="panel">
            <a class="button" href="<?=htmlspecialcharsbx($_SERVER['PHP_SELF'])?>">Dry-run</a>
            <form method="post" style="display:inline" onsubmit="return confirm('Записать только полные ответы FAQ?');">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="mode" value="apply">
                <button class="apply" type="submit">Apply FAQ answers</button>
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

function propertyExists(int $iblockId, string $code): bool
{
    return (bool)CIBlockProperty::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => $iblockId, 'CODE' => $code]
    )->Fetch();
}

function blockByCode(int $iblockId, string $code): ?array
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

$faqAnswers = [
    'auto-faq' => [
        'Краткое описание ситуации, документы по ремонту или обслуживанию — если есть, фото и видео, перечень вопросов и данные автомобиля: VIN, модель, год.',
        'Да. Досудебное заключение помогает сформировать позицию, уточнить круг вопросов и подготовить материалы для суда — при необходимости.',
        'По большинству распространенных марок — да. Перечень на сайте не полный, поэтому лучше уточнить возможность диагностики по конкретной модели.',
    ],

    'construction-faq' => [
        'Определение суда или описание спора, договор и техническое задание, проектная, рабочая, исполнительная и сметная документация — в зависимости от задачи.',
        'Да. Досудебное исследование позволяет установить технические обстоятельства спора и определить целесообразность дальнейшего судебного разбирательства.',
        'Зависит от поставленных вопросов и имеющихся материалов. Возможность исследования без осмотра определяется после предварительного анализа документов.',
    ],

    'engineering-faq' => [
        'Определение суда или описание спора, паспорт и руководство по эксплуатации, конструкторская и техническая документация, сведения о монтаже, пусконаладке, ремонтах и техническом обслуживании, а также материалы об обстоятельствах возникновения неисправности.',
        'Зависит от поставленных вопросов. Для установления технического состояния, характера повреждений и причин отказа во многих случаях требуется непосредственный осмотр и инструментальное исследование объекта.',
        'Возможность исследования зависит от сохранности замененных деталей и узлов, фото- и видеофиксации первоначального состояния, актов дефектовки и ремонта, журналов эксплуатации и иных исходных материалов.',
        'Да. При наличии достаточных исходных данных возможно определить необходимый состав КД, сложность и объем инженерных работ, расчетную трудоемкость, необходимый состав специалистов и стоимость разработки, восстановления или доработки документации.',
        'Инженерно-техническая экспертиза исследует устройство и техническое состояние оборудования, механизм и причины отказов, конструктивные решения и конструкторскую документацию. Товароведческая экспертиза в первую очередь решает вопросы идентификации товара, его качества, комплектности и соответствия заявленным или договорным характеристикам.',
    ],

    'finecon-faq' => [
        'Для первичной оценки достаточно вопросов эксперту, краткого описания спора и основных финансовых документов. Полный состав материалов определяется после анализа задачи.',
        'Период определяется предметом спора и вопросами эксперту. Для финансового анализа важно установить конкретные даты или временной интервал исследования.',
        'Да. Эксперт может проверить исходные данные, примененный алгоритм, финансовые показатели и правильность расчета и определить, подтверждается ли полученный результат представленными документами.',
        'Да. Экспертиза может включать анализ платежеспособности, активов и обязательств, денежных потоков и динамики финансового состояния за установленный период.',
    ],

    'accounting-faq' => [
        'Для первичной оценки задачи достаточно вопросов эксперту, описания спора и основных документов по исследуемым операциям. Полный перечень материалов определяется после изучения предмета экспертизы.',
        'Да, если представлены документы, позволяющие установить начисления, платежи, зачеты и иные операции, влияющие на состояние взаиморасчетов.',
        'Возможность исследования зависит от поставленных вопросов и значения отсутствующих документов. Эксперт оценивает достаточность материалов для получения обоснованного вывода.',
        'Как правило, исследование проводится в пределах поставленных вопросов, определенных операций, счетов и периода, имеющих значение для конкретного спора.',
    ],

    'valuation-faq' => [
        'Да. При наличии достаточных исходных данных возможно провести ретроспективное исследование и определить стоимость объекта на заданную дату.',
        'Зависит от вида объекта, даты оценки, поставленных вопросов и имеющихся материалов. Возможность проведения исследования без осмотра определяется после анализа задачи.',
        'Да. Экспертиза может включать определение стоимости бизнеса, доли участия или пакета акций на установленную дату.',
        'Да. В рамках рецензирования исследуются исходные данные, примененные подходы и методы, объекты-аналоги, корректировки, расчеты и обоснованность итогового вывода о стоимости.',
    ],
];

$blocksIblockId = iblockId('best_service_blocks');

if (!propertyExists($blocksIblockId, 'FAQ_ANSWERS')) {
    fail('Property FAQ_ANSWERS is missing. Run content-platform-migrate.php first.');
}

out('BEST FAQ answers backfill');
out('Mode: ' . ($apply ? 'APPLY' : 'DRY RUN'));
out('');

$updated = 0;
$skipped = 0;

foreach ($faqAnswers as $code => $answers) {
    $block = blockByCode($blocksIblockId, $code);

    if (!$block) {
        out(sprintf('[skip] %s — block not found', $code));
        $skipped++;
        continue;
    }

    out(sprintf(
        '[%s] %s (#%d): %d full answer(s)',
        $apply ? 'write' : 'plan',
        $code,
        (int)$block['ID'],
        count($answers)
    ));

    if ($apply) {
        CIBlockElement::SetPropertyValuesEx(
            (int)$block['ID'],
            $blocksIblockId,
            ['FAQ_ANSWERS' => $answers]
        );
        $updated++;
    }
}

out('');
out($apply
    ? sprintf('Done. FAQ_ANSWERS updated for %d block(s); skipped %d. No other fields or properties were changed.', $updated, $skipped)
    : 'Dry run finished. Apply writes only FAQ_ANSWERS.'
);

if (!$isCli) {
    echo '</pre></body></html>';
}
