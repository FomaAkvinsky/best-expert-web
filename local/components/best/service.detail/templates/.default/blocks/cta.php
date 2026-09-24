<?php
$props = $block['PROPERTIES'];
$label = trim((string)($props['CTA_LABEL']['VALUE'] ?? 'Оставить запрос'));
$url = trim((string)($props['CTA_URL']['VALUE'] ?? '#b24-form'));

$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section bg-gray-700 particles-js-outer');
$containerClass = bestServiceBlockClass($block, 'CONTAINER_CLASS', 'container');
$contentRowClass = bestServiceBlockClass($block, 'CONTENT_ROW_CLASS', 'row justify-content-center justify-content-xl-between align-items-center');
$titleClass = bestServiceBlockClass($block, 'TITLE_CLASS', 'wow fadeInLeftSmall');
?>
<section class="<?=htmlspecialcharsbx($sectionClass)?>">
    <div id="particles-js"></div>
    <div class="<?=htmlspecialcharsbx($containerClass)?>">
        <div class="<?=htmlspecialcharsbx($contentRowClass)?>">
            <div class="col-lg-8">
                <div class="section-lg">
                    <?php if (!empty($props['EYEBROW']['VALUE'])): ?>
                        <h6 class="wow fadeInLeftSmall"><?=htmlspecialcharsbx((string)$props['EYEBROW']['VALUE'])?></h6>
                    <?php endif; ?>
                    <h2 class="<?=htmlspecialcharsbx($titleClass)?>" data-wow-delay=".1s"><?=htmlspecialcharsbx($block['NAME'])?></h2>
                    <?php if (!empty($props['INTRO']['VALUE'])): ?>
                        <p class="lead wow fadeInLeftSmall" data-wow-delay=".15s"><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 pb-4">
                <div class="wow fadeInUpSmall">
                    <a class="button button-primary" href="<?=htmlspecialcharsbx($url)?>"><?=htmlspecialcharsbx($label)?></a>
                </div>
            </div>
        </div>
    </div>
</section>
