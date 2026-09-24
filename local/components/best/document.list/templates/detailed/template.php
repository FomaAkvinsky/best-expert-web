<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="row row-30">
    <?php foreach ($arResult['ITEMS'] as $index => $item): ?>
        <?php
        $properties = $item['PROPERTIES'];
        $number = trim((string)($properties['NUMBER']['VALUE'] ?? ''));
        $issuer = trim((string)($properties['ISSUER']['VALUE'] ?? ''));
        $issueDate = trim((string)($properties['ISSUE_DATE']['VALUE'] ?? ''));
        ?>
        <div class="col-md-6 wow fadeInUpSmall"<?=$index ? ' data-wow-delay=".08s"' : ''?>>
            <div class="services-divider__card h-100">
                <h3 class="h5 mb-3"><?=htmlspecialcharsbx($item['NAME'])?></h3>

                <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                    <p><?=$item['PREVIEW_TEXT']?></p>
                <?php endif; ?>

                <ul class="list-marked mt-3">
                    <?php if ($number !== ''): ?><li><?=htmlspecialcharsbx($number)?></li><?php endif; ?>
                    <?php if ($issueDate !== ''): ?><li><?=htmlspecialcharsbx($issueDate)?></li><?php endif; ?>
                    <?php if ($issuer !== ''): ?><li><?=htmlspecialcharsbx($issuer)?></li><?php endif; ?>
                </ul>

                <?php if (!empty($item['DETAIL_TEXT'])): ?>
                    <div class="mt-3"><?=$item['DETAIL_TEXT']?></div>
                <?php endif; ?>

                <p class="mt-4 mb-0">
                    <a href="/accreditation/">Документы и реквизиты →</a>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
