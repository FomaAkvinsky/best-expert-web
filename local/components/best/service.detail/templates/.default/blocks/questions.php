<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));
?>
<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($eyebrow !== ''): ?><h6><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                <h2><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if (!empty($props['INTRO']['VALUE'])): ?>
                    <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">
                <div class="services-divider__card">
                    <ul class="list-marked">
                        <?php foreach ($items as $item): ?>
                            <li><?=htmlspecialcharsbx((string)$item)?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
