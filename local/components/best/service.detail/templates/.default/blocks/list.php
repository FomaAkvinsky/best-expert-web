<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
?>
<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">
                <h2><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if ($intro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>
                <ul class="list-marked">
                    <?php foreach ($items as $item): ?>
                        <li><?=htmlspecialcharsbx((string)$item)?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
