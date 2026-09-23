<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$descriptions = (array)($props['ITEMS']['DESCRIPTION'] ?? []);
$layout = (int)($block['LAYOUT'] ?: 2);
$layout = in_array($layout, [1,2,3,4], true) ? $layout : 2;
$col = [1 => 12, 2 => 6, 3 => 4, 4 => 3][$layout];
$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
?>
<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($eyebrow !== ''): ?><h6><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                <h2><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if ($intro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>
            </div>
        </div>

        <div class="row row-30 justify-content-center">
            <?php foreach ($items as $i => $title): ?>
                <div class="col-md-10 col-lg-<?=$col?>">
                    <div class="services-divider__card h-100">
                        <h3 class="h5 mb-3"><?=htmlspecialcharsbx((string)$title)?></h3>
                        <?php if (!empty($descriptions[$i])): ?>
                            <p><?=nl2br(htmlspecialcharsbx((string)$descriptions[$i]))?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
