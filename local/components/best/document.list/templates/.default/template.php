<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div class="row row-30">
    <?php foreach ($arResult['ITEMS'] as $item): ?>
        <?php
        $properties = $item['PROPERTIES'];
        $fileId = (int)($properties['FILE']['VALUE'] ?? 0);
        $fileUrl = $fileId ? CFile::GetPath($fileId) : '';
        $externalUrl = trim((string)($properties['EXTERNAL_URL']['VALUE'] ?? ''));
        ?>
        <div class="col-md-6">
            <div class="services-divider__card h-100">
                <h3 class="h5 mb-3"><?=htmlspecialcharsbx($item['NAME'])?></h3>
                <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                    <p><?=$item['PREVIEW_TEXT']?></p>
                <?php endif; ?>

                <?php if ($fileUrl || $externalUrl): ?>
                    <div class="mt-3">
                        <?php if ($fileUrl): ?>
                            <a class="button button-sm button-primary" href="<?=htmlspecialcharsbx($fileUrl)?>" target="_blank" rel="noopener">Открыть документ</a>
                        <?php endif; ?>
                        <?php if ($externalUrl): ?>
                            <a class="button button-sm button-default-outline" href="<?=htmlspecialcharsbx($externalUrl)?>" target="_blank" rel="noopener">Проверить в реестре</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
