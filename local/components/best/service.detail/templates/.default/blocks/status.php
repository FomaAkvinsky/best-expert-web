<?php
$props = $block['PROPERTIES'];
$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
?>
<section class="section section-lg bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8 text-center">
        <?php if ($eyebrow !== ''): ?>
          <h6 class="wow fadeInUpSmall"><?=htmlspecialcharsbx($eyebrow)?></h6>
        <?php endif; ?>
        <h2 class="wow fadeInUpSmall" data-wow-delay=".1s"><?=htmlspecialcharsbx($block['NAME'])?></h2>
        <?php if ($intro !== ''): ?>
          <p class="wow fadeInUpSmall" data-wow-delay=".2s"><?=nl2br(htmlspecialcharsbx($intro))?></p>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($block['DOCUMENT_ITEMS']): ?>
      <div class="row row-30 justify-content-center">
        <?php foreach ($block['DOCUMENT_ITEMS'] as $index => $document): ?>
          <?php
          $dp = $document['PROPERTIES'];
          $number = trim((string)($dp['NUMBER']['VALUE'] ?? ''));
          $issueDate = trim((string)($dp['ISSUE_DATE']['VALUE'] ?? ''));
          ?>
          <div class="col-md-6 wow fadeInUpSmall"<?=$index ? ' data-wow-delay=".08s"' : ''?>>
            <div class="services-divider__card h-100">
              <h3 class="h5 mb-3"><?=htmlspecialcharsbx($document['NAME'])?></h3>

              <?php if (!empty($document['PREVIEW_TEXT'])): ?>
                <p><?=$document['PREVIEW_TEXT']?></p>
              <?php endif; ?>

              <?php if ($number !== '' || $issueDate !== ''): ?>
                <p class="mt-3" style="opacity:.78;">
                  <?php if ($number !== ''): ?><?=htmlspecialcharsbx($number)?><?php endif; ?>
                  <?php if ($number !== '' && $issueDate !== ''): ?> · <?php endif; ?>
                  <?php if ($issueDate !== ''): ?><?=htmlspecialcharsbx($issueDate)?><?php endif; ?>
                </p>
              <?php endif; ?>

              <p class="mt-3 mb-0">
                <a href="/accreditation/">Подробнее о профессиональном статусе →</a>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="text-center mt-4">
      <a class="button button-default-outline" href="/accreditation/">Документы и профессиональный статус</a>
    </div>
  </div>
</section>
