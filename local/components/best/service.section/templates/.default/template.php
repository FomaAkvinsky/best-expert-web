<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$section = $arResult['SECTION'];
$description = trim((string)($section['DESCRIPTION'] ?? ''));
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
                    <?php if ($description !== ''): ?>
                        <div class="lead"><?=$section['DESCRIPTION']?></div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 text-center">
                    <a class="button button-primary" href="#b24-form">Оставить запрос</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <h6>направления</h6>
                <h2>Услуги направления</h2>
            </div>
        </div>

        <?php
        $APPLICATION->IncludeComponent(
            'best:service.list',
            '',
            [
                'IBLOCK_CODE' => 'best_services',
                'SECTION_CODE' => (string)$section['CODE'],
                'CACHE_TYPE' => 'A',
                'CACHE_TIME' => 3600,
            ]
        );
        ?>
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
