<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$routeSectionCode = trim((string)($arResult['ROUTE_SECTION_CODE'] ?? ''));
?>

<div class="row row-30">
    <?php foreach ($arResult['ITEMS'] as $item): ?>
        <?php
        $code = trim((string)($item['CODE'] ?? ''));
        $hasLink = ($routeSectionCode !== '' && $code !== '');
        $href = $hasLink
            ? '/services/' . rawurlencode($routeSectionCode) . '/' . rawurlencode($code) . '/'
            : '#';
        ?>
        <div class="col-12">
            <a class="link-box"
               style="max-width:100%"
               href="<?=htmlspecialcharsbx($href)?>"
               <?php if (!$hasLink): ?>onclick="return false;" aria-disabled="true"<?php endif; ?>>
                <?php if (!empty($item['PROPERTY_ICON_VALUE'])): ?>
                    <span class="icon link-box__icon <?=htmlspecialcharsbx($item['PROPERTY_ICON_VALUE'])?>"></span>
                <?php endif; ?>

                <div class="link-box__main">
                    <h4><?=htmlspecialcharsbx($item['NAME'])?></h4>

                    <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                        <?php if (($item['PREVIEW_TEXT_TYPE'] ?? 'text') === 'html'): ?>
                            <?=$item['PREVIEW_TEXT']?>
                        <?php else: ?>
                            <p><?=nl2br(htmlspecialcharsbx($item['PREVIEW_TEXT']))?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
