<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$section = $arResult['SECTION'];
$children = $arResult['CHILD_SECTIONS'];

$heroSubtitle = trim((string)($section['UF_HERO_SUBTITLE'] ?? ''));
$introTitle = trim((string)($section['UF_INTRO_TITLE'] ?? ''));
$introText = trim((string)($section['UF_INTRO_TEXT'] ?? ''));
$listEyebrow = trim((string)($section['UF_LIST_EYEBROW'] ?? ''));
$listTitle = trim((string)($section['UF_LIST_TITLE'] ?? ''));
$listIntro = trim((string)($section['UF_LIST_INTRO'] ?? ''));
?>

<section class="section parallax-container section-md bg-gray-700 section-overlay-3"
         data-parallax-img="/local/templates/best/assets/images/features-parallax-1.jpg">
    <div class="material-parallax parallax">
        <img src="/local/templates/best/assets/images/features-parallax-1.jpg" alt=""
             style="display:block; transform:translate3d(-50%, 200px, 0px);">
    </div>

    <div class="parallax-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10 col-lg-8">
                    <ul class="brumbs-custom">
                        <li><a href="/">Главная</a></li>
                        <li><a href="/services/">Услуги</a></li>
                        <li class="active"><?=htmlspecialcharsbx($section['NAME'])?></li>
                    </ul>

                    <h1><?=htmlspecialcharsbx($section['NAME'])?></h1>

                    <?php if ($heroSubtitle !== ''): ?>
                        <p class="lead"><?=nl2br(htmlspecialcharsbx($heroSubtitle))?></p>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 text-center">
                    <a class="button button-primary" href="#b24-form">Оставить запрос</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($introTitle !== '' || $introText !== ''): ?>
<section class="bg-gray-100 py-4">
    <div class="container">
        <div class="profile-light">
            <div class="profile-light__main">
                <div class="profile-light__inner" style="max-width:980px;">
                    <?php if ($introTitle !== ''): ?>
                        <h4 class="profile-light__title"><?=htmlspecialcharsbx($introTitle)?></h4>
                    <?php endif; ?>

                    <?php if ($introText !== ''): ?>
                        <div class="profile-light__text">
                            <?php foreach (preg_split('/\R\R+/', $introText) as $paragraph): ?>
                                <?php if (trim($paragraph) !== ''): ?>
                                    <p><?=nl2br(htmlspecialcharsbx(trim($paragraph)))?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($listEyebrow !== ''): ?><h6><?=htmlspecialcharsbx($listEyebrow)?></h6><?php endif; ?>
                <?php if ($listTitle !== ''): ?><h2><?=htmlspecialcharsbx($listTitle)?></h2><?php endif; ?>
                <?php if ($listIntro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($listIntro))?></p><?php endif; ?>
            </div>
        </div>

        <div class="row row-50">
            <?php foreach ($children as $child): ?>
                <div class="col-xl-9">
                    <h3 class="h4"><?=htmlspecialcharsbx($child['NAME'])?></h3>

                    <?php if (!empty($child['DESCRIPTION'])): ?>
                        <?php if (($child['DESCRIPTION_TYPE'] ?? 'text') === 'html'): ?>
                            <div><?=$child['DESCRIPTION']?></div>
                        <?php else: ?>
                            <p><?=nl2br(htmlspecialcharsbx($child['DESCRIPTION']))?></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php
                    $APPLICATION->IncludeComponent(
                        'best:service.list',
                        '',
                        [
                            'IBLOCK_CODE' => 'best_services',
                            'SECTION_CODE' => (string)$child['CODE'],
                            'ROUTE_SECTION_CODE' => (string)$section['CODE'],
                            'CACHE_TYPE' => 'A',
                            'CACHE_TIME' => 3600,
                        ]
                    );
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-lg bg-gray-100">
    <div class="container">
        <div class="row row-40 justify-content-center">
            <div class="col-md-10 col-lg-6">
                <h3>Как выбрать нужный формат</h3>
                <div class="divider-modern"></div>
                <p>
                    Если вы не уверены, какой вид экспертизы нужен, мы начинаем с оценки материалов и процессуального контекста:
                    что именно требуется доказать, какие риски оспаривания возможны, какие вопросы корректно ставить.
                </p>
            </div>

            <div class="col-md-10 col-lg-6">
                <div class="card-group-custom card-group-line" id="accordion-services" role="tablist" aria-multiselectable="true">
                    <article class="card card-custom card-line">
                        <div class="card-header" id="accordion-servicesHeading1" role="tab">
                            <div class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                                   data-target="#accordion-servicesCollapse1" href="#" onclick="return false;"
                                   aria-controls="accordion-servicesCollapse1" aria-expanded="false">
                                    Что нужно для первичной оценки?
                                    <div class="card-arrow"></div>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="accordion-servicesCollapse1" role="tabpanel" aria-labelledby="accordion-servicesHeading1">
                            <div class="card-body">
                                <p>Краткое описание спора, перечень документов и материалов, вопросы — если уже сформированы — и срок, к которому нужен результат.</p>
                            </div>
                        </div>
                    </article>

                    <article class="card card-custom card-line">
                        <div class="card-header" id="accordion-servicesHeading2" role="tab">
                            <div class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                                   data-target="#accordion-servicesCollapse2" href="#" onclick="return false;"
                                   aria-controls="accordion-servicesCollapse2" aria-expanded="false">
                                    Можно ли подключиться до назначения экспертизы судом?
                                    <div class="card-arrow"></div>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="accordion-servicesCollapse2" role="tabpanel" aria-labelledby="accordion-servicesHeading2">
                            <div class="card-body">
                                <p>Да. Мы помогаем корректно поставить вопросы и собрать материалы так, чтобы снизить риск повторных экспертиз и процессуальных затяжек.</p>
                            </div>
                        </div>
                    </article>

                    <article class="card card-custom card-line">
                        <div class="card-header" id="accordion-servicesHeading3" role="tab">
                            <div class="card-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion-services"
                                   data-target="#accordion-servicesCollapse3" href="#" onclick="return false;"
                                   aria-controls="accordion-servicesCollapse3" aria-expanded="false">
                                    Делаете ли вы разъяснения в суде?
                                    <div class="card-arrow"></div>
                                </a>
                            </div>
                        </div>
                        <div class="collapse" id="accordion-servicesCollapse3" role="tabpanel" aria-labelledby="accordion-servicesHeading3">
                            <div class="card-body">
                                <p>При необходимости обеспечиваем экспертное сопровождение: разъяснение методики и выводов, ответы на вопросы сторон и суда.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-gray-700 particles-js-outer">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row justify-content-center justify-content-xl-between align-items-center">
            <div class="col-lg-8">
                <div class="section-lg">
                    <h6>оценка задачи</h6>
                    <h2>Нужна экспертиза, которая выдержит процессуальное давление?</h2>
                    <p class="lead">
                        Оставьте запрос — мы оценим материалы, риски и предложим оптимальный формат работы и сроки.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 pb-4">
                <a class="button button-primary" href="#b24-form">Оставить запрос</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-lg" id="b24-form">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between row-2-columns-bordered row-50">
            <div class="col-md-10 col-lg-4">
                <h3>Свяжитесь с нами</h3>
                <ul class="list-creative">
                    <li>
                        <dl class="list-terms-medium">
                            <dt>Телефон</dt>
                            <dd><a href="tel:+79035220546">+7 903 522-0546</a></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="list-terms-medium">
                            <dt>E-mail</dt>
                            <dd><a href="mailto:ask@best-expert.pro">ask@best-expert.pro</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 col-lg-7">
                <h3>Форма обратной связи</h3>
                <div class="application-form">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/main-form.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>
