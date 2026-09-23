<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<div class="row row-30 justify-content-center">
    <?php foreach ($arResult['ITEMS'] as $index => $item): ?>
        <?php
        $properties = $item['PROPERTIES'];
        $number = trim((string)($properties['NUMBER']['VALUE'] ?? ''));
        $issueDate = trim((string)($properties['ISSUE_DATE']['VALUE'] ?? ''));
        ?>
        <div class="col-md-6 wow fadeInUpSmall"<?=$index ? ' data-wow-delay=".08s"' : ''?>>
            <div class="services-divider__card h-100">
                <h3 class="h5 mb-3"><?=htmlspecialcharsbx($item['NAME'])?></h3>
                <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                    <p><?=$item['PREVIEW_TEXT']?></p>
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
