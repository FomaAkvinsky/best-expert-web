<?php
$props = $block['PROPERTIES'];
$label = trim((string)($props['CTA_LABEL']['VALUE'] ?? 'Оставить запрос'));
$url = trim((string)($props['CTA_URL']['VALUE'] ?? '#b24-form'));
?>
<section class="section bg-gray-700 particles-js-outer">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row justify-content-center justify-content-xl-between align-items-center">
            <div class="col-lg-8">
                <div class="section-lg">
                    <?php if (!empty($props['EYEBROW']['VALUE'])): ?>
                        <h6 class="wow fadeInLeftSmall"><?=htmlspecialcharsbx((string)$props['EYEBROW']['VALUE'])?></h6>
                    <?php endif; ?>
                    <h2 class="wow fadeInLeftSmall" data-wow-delay=".1s"><?=htmlspecialcharsbx($block['NAME'])?></h2>
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
