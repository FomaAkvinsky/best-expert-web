<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$descriptions = (array)($props['ITEMS']['DESCRIPTION'] ?? []);
?>
<section class="section section-lg bg-gray-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-9">
        <h2><?=htmlspecialcharsbx($block['NAME'])?></h2>
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
      </div>
    </div>
  </div>
</section>
