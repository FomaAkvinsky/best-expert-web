<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));

$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section section-lg bg-white');
$containerClass = bestServiceBlockClass($block, 'CONTAINER_CLASS', 'container');
$headingRowClass = bestServiceBlockClass($block, 'HEADING_ROW_CLASS', 'row justify-content-center');
$headingColClass = bestServiceBlockClass($block, 'HEADING_COL_CLASS', 'col-md-10 col-lg-8 text-center');
$titleClass = bestServiceBlockClass($block, 'TITLE_CLASS', '');
$contentRowClass = bestServiceBlockClass($block, 'CONTENT_ROW_CLASS', 'row justify-content-center');
$contentColClass = bestServiceBlockClass($block, 'CONTENT_COL_CLASS', 'col-md-10 col-lg-9');
?>
<?php bestServiceBlockSectionStart($block, $sectionClass); ?>
    <div class="<?=htmlspecialcharsbx($containerClass)?>">
        <div class="<?=htmlspecialcharsbx($headingRowClass)?>">
            <div class="<?=htmlspecialcharsbx($headingColClass)?>">
                <?php if ($eyebrow !== ''): ?><h6><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                <h2<?php if ($titleClass !== ''): ?> class="<?=htmlspecialcharsbx($titleClass)?>"<?php endif; ?>><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if (!empty($props['INTRO']['VALUE'])): ?>
                    <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="<?=htmlspecialcharsbx($contentRowClass)?>">
            <div class="<?=htmlspecialcharsbx($contentColClass)?>">
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
