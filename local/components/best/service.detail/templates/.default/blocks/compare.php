<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$descriptions = (array)($props['ITEMS']['DESCRIPTION'] ?? []);

$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section section-lg bg-gray-100');
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
        <?php if (!empty($props['INTRO']['VALUE'])): ?>
          <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
        <?php endif; ?>
        <div class="row row-30">
          <?php foreach ($items as $i => $title): ?>
            <div class="col-md-6">
              <div class="services-divider__card h-100">
                <h3 class="h5"><?=htmlspecialcharsbx((string)$title)?></h3>
                <?php if (!empty($descriptions[$i])): ?>
                  <p><?=nl2br(htmlspecialcharsbx((string)$descriptions[$i]))?></p>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php if (!empty($block['DETAIL_TEXT'])): ?>
          <div class="mt-4"><?=$block['DETAIL_TEXT']?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
