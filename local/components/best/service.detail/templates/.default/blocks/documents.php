<?php
$props = $block['PROPERTIES'];

$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section section-lg bg-white');
$containerClass = bestServiceBlockClass($block, 'CONTAINER_CLASS', 'container');
$contentRowClass = bestServiceBlockClass($block, 'CONTENT_ROW_CLASS', 'row justify-content-center');
$contentColClass = bestServiceBlockClass($block, 'CONTENT_COL_CLASS', 'col-md-10 col-lg-9');
$titleClass = bestServiceBlockClass($block, 'TITLE_CLASS', '');
?>
<?php bestServiceBlockSectionStart($block, $sectionClass); ?>
  <div class="<?=htmlspecialcharsbx($containerClass)?>">
    <div class="<?=htmlspecialcharsbx($contentRowClass)?>">
      <div class="<?=htmlspecialcharsbx($contentColClass)?>">
        <h2<?php if ($titleClass !== ''): ?> class="<?=htmlspecialcharsbx($titleClass)?>"<?php endif; ?>><?=htmlspecialcharsbx($block['NAME'])?></h2>
        <?php if (!empty($props['INTRO']['VALUE'])): ?>
          <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
        <?php endif; ?>

        <div class="row row-30">
          <?php foreach ($block['DOCUMENT_ITEMS'] as $document): ?>
            <?php
            $dp = $document['PROPERTIES'];
            $fileId = (int)($dp['FILE']['VALUE'] ?? 0);
            $fileUrl = $fileId ? CFile::GetPath($fileId) : '';
            $externalUrl = trim((string)($dp['EXTERNAL_URL']['VALUE'] ?? ''));
            ?>
            <div class="col-md-6">
              <div class="services-divider__card h-100">
                <h3 class="h5 mb-3"><?=htmlspecialcharsbx($document['NAME'])?></h3>
                <?php if (!empty($document['PREVIEW_TEXT'])): ?>
                  <p><?=$document['PREVIEW_TEXT']?></p>
                <?php endif; ?>
                <div class="mt-3">
                  <?php if ($fileUrl): ?>
                    <a class="button button-sm button-primary" href="<?=htmlspecialcharsbx($fileUrl)?>" target="_blank" rel="noopener">Открыть документ</a>
                  <?php endif; ?>
                  <?php if ($externalUrl): ?>
                    <a class="button button-sm button-default-outline" href="<?=htmlspecialcharsbx($externalUrl)?>" target="_blank" rel="noopener">Проверить</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
