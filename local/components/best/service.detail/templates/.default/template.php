<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$service = $arResult['SERVICE'];
$section = $arResult['SECTION'];
$properties = $service['PROPERTIES'];
$heroSubtitle = trim((string)($properties['HERO_SUBTITLE']['VALUE'] ?? ''));

if (!function_exists('bestServiceBlockClass')) {
    function bestServiceBlockClass(array $block, string $propertyCode, string $default = ''): string
    {
        $value = trim((string)($block['PROPERTIES'][$propertyCode]['VALUE'] ?? ''));
        return $value !== '' ? $value : $default;
    }
}

if (!function_exists('bestServiceBlockBackground')) {
    function bestServiceBlockBackground(array $block): array
    {
        $props = $block['PROPERTIES'] ?? [];
        $fileId = (int)($props['BACKGROUND_IMAGE']['VALUE'] ?? 0);

        if ($fileId <= 0) {
            return [
                'enabled' => false,
                'class' => '',
                'style' => '',
                'image' => '',
            ];
        }

        $image = (string)CFile::GetPath($fileId);
        if ($image === '') {
            return [
                'enabled' => false,
                'class' => '',
                'style' => '',
                'image' => '',
            ];
        }

        $side = in_array(($block['BACKGROUND_SIDE'] ?? ''), ['left', 'right'], true)
            ? (string)$block['BACKGROUND_SIDE']
            : 'right';

        $vertical = in_array(($block['BACKGROUND_VERTICAL'] ?? ''), ['top', 'center', 'bottom'], true)
            ? (string)$block['BACKGROUND_VERTICAL']
            : 'center';

        $fade = in_array(($block['BACKGROUND_FADE'] ?? ''), ['none', 'soft', 'medium', 'strong'], true)
            ? (string)$block['BACKGROUND_FADE']
            : 'soft';

        $mobile = (($block['BACKGROUND_MOBILE'] ?? '') === 'show') ? 'show' : 'hide';

        $width = trim((string)($props['BACKGROUND_WIDTH']['VALUE'] ?? ''));
        if ($width === '' || !preg_match('/^(?:\\d+(?:\\.\\d+)?)(?:%|px|rem|vw)$/', $width)) {
            $width = '44%';
        }

        $opacityRaw = str_replace(',', '.', trim((string)($props['BACKGROUND_OPACITY']['VALUE'] ?? '')));
        $opacity = is_numeric($opacityRaw) ? (float)$opacityRaw : 1.0;
        $opacity = max(0.0, min(1.0, $opacity));

        return [
            'enabled' => true,
            'class' => implode(' ', [
                'best-block-art',
                'best-block-art--' . $side,
                'best-block-art--' . $vertical,
                'best-block-art--fade-' . $fade,
                'best-block-art--mobile-' . $mobile,
            ]),
            'style' => '--best-block-art-width:' . $width . ';--best-block-art-opacity:' . rtrim(rtrim(number_format($opacity, 2, '.', ''), '0'), '.') . ';',
            'image' => $image,
        ];
    }
}

if (!function_exists('bestServiceBlockSectionStart')) {
    function bestServiceBlockSectionStart(array $block, string $sectionClass, string $extraAttributes = ''): void
    {
        $background = bestServiceBlockBackground($block);
        $classes = trim($sectionClass . ($background['enabled'] ? ' best-block-art-section' : ''));

        echo '<section class="' . htmlspecialcharsbx($classes) . '"' . $extraAttributes . '>';

        if ($background['enabled']) {
            echo '<div class="' . htmlspecialcharsbx($background['class']) . '" style="' . htmlspecialcharsbx($background['style']) . '" aria-hidden="true">';
            echo '<img src="' . htmlspecialcharsbx($background['image']) . '" alt="" loading="lazy" decoding="async">';
            echo '</div>';
        }
    }
}
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
                        <li><a href="/services/<?=htmlspecialcharsbx($section['CODE'])?>/"><?=htmlspecialcharsbx($section['NAME'])?></a></li>
                        <li class="active"><?=htmlspecialcharsbx($service['NAME'])?></li>
                    </ul>

                    <h1 class="wow fadeInUpSmall"><?=htmlspecialcharsbx($service['NAME'])?></h1>

                    <?php if ($heroSubtitle !== ''): ?>
                        <p class="lead wow fadeInUpSmall" data-wow-delay=".1s"><?=nl2br(htmlspecialcharsbx($heroSubtitle))?></p>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 text-center">
                    <div class="wow fadeInUpSmall" data-wow-delay=".2s">
                        <a class="button button-primary" href="#b24-form">Оставить запрос</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$blocks = $arResult['BLOCKS'];
$blockCount = count($blocks);

for ($blockIndex = 0; $blockIndex < $blockCount; $blockIndex++):
    $block = $blocks[$blockIndex];

    if (($block['TYPE'] ?? '') === 'questions') {
        $questionBlocks = [];

        while (
            $blockIndex < $blockCount
            && (($blocks[$blockIndex]['TYPE'] ?? '') === 'questions')
        ) {
            $questionBlocks[] = $blocks[$blockIndex];
            $blockIndex++;
        }

        $blockIndex--;
        include __DIR__ . '/blocks/questions-group.php';
        continue;
    }

    $type = preg_replace('/[^a-z0-9_-]/i', '', (string)($block['TYPE'] ?? ''));
    $file = __DIR__ . '/blocks/' . $type . '.php';

    if (!$type || !is_file($file)) {
        $file = __DIR__ . '/blocks/profile.php';
    }

    include $file;
endfor;
?>

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
