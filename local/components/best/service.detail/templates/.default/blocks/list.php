<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section section-lg bg-white');
$containerClass = bestServiceBlockClass($block, 'CONTAINER_CLASS', 'container');
$contentRowClass = bestServiceBlockClass($block, 'CONTENT_ROW_CLASS', 'row justify-content-center');
$contentColClass = bestServiceBlockClass($block, 'CONTENT_COL_CLASS', 'col-md-10 col-lg-9');
$titleClass = bestServiceBlockClass($block, 'TITLE_CLASS', '');
?>
<section class="<?=htmlspecialcharsbx($sectionClass)?>">
    <div class="<?=htmlspecialcharsbx($containerClass)?>">
        <div class="<?=htmlspecialcharsbx($contentRowClass)?>">
            <div class="<?=htmlspecialcharsbx($contentColClass)?>">
                <h2<?php if ($titleClass !== ''): ?> class="<?=htmlspecialcharsbx($titleClass)?>"<?php endif; ?>><?=htmlspecialcharsbx($block['NAME'])?></h2>
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
