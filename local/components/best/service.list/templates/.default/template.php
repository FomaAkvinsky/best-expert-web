<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div class="row row-30">
    <?php foreach ($arResult['ITEMS'] as $item): ?>
        <div class="col-12">
            <a class="link-box" style="max-width:100%" href="<?=htmlspecialcharsbx($item['DETAIL_PAGE_URL'])?>">
                <?php if (!empty($item['PROPERTY_ICON_VALUE'])): ?>
                    <span class="icon link-box__icon <?=htmlspecialcharsbx($item['PROPERTY_ICON_VALUE'])?>"></span>
                <?php endif; ?>
                <div class="link-box__main">
                    <h4><?=htmlspecialcharsbx($item['NAME'])?></h4>
                    <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                        <p><?=$item['PREVIEW_TEXT']?></p>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
