<?php
$props = $block['PROPERTIES'];
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
?>
<section class="section section-lg bg-white">
  <div class="container">
    <h2><?=htmlspecialcharsbx($block['NAME'])?></h2>
    <?php if ($intro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>

    <?php if ($block['DOCUMENT_ITEMS']): ?>
      <div class="row row-30 mt-2">
        <?php foreach ($block['DOCUMENT_ITEMS'] as $document): ?>
          <?php
          $dp = $document['PROPERTIES'];
          $fileId = (int)($dp['FILE']['VALUE'] ?? 0);
          $fileUrl = $fileId ? CFile::GetPath($fileId) : '';
          $externalUrl = trim((string)($dp['EXTERNAL_URL']['VALUE'] ?? ''));
          ?>
          <div class="col-md-6">
            <div class="services-divider__card h-100">
              <h3 class="h5"><?=htmlspecialcharsbx($document['NAME'])?></h3>
              <?php if (!empty($document['PREVIEW_TEXT'])): ?><p><?=$document['PREVIEW_TEXT']?></p><?php endif; ?>
              <?php if ($fileUrl): ?>
                <a href="<?=htmlspecialcharsbx($fileUrl)?>" target="_blank" rel="noopener">Смотреть документ →</a>
              <?php endif; ?>
              <?php if ($externalUrl): ?>
                <div><a href="<?=htmlspecialcharsbx($externalUrl)?>" target="_blank" rel="noopener">Проверить в реестре →</a></div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
