<?php
$props = $block['PROPERTIES'];
$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
$anchor = trim((string)($props['ANCHOR']['VALUE'] ?? ''));
?>
<section class="bg-gray-100 py-4"<?=$anchor ? ' id="'.htmlspecialcharsbx($anchor).'"' : ''?>>
    <div class="container">
        <div class="profile-light">
            <div class="profile-light__main">
                <div class="profile-light__inner" style="max-width:980px;">
                    <?php if ($eyebrow !== ''): ?><h6><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                    <h4 class="profile-light__title"><?=htmlspecialcharsbx($block['NAME'])?></h4>
                    <?php if ($intro !== ''): ?>
                        <div class="profile-light__text"><p><?=nl2br(htmlspecialcharsbx($intro))?></p></div>
                    <?php endif; ?>
                    <?php if (!empty($block['DETAIL_TEXT'])): ?>
                        <div class="profile-light__text"><?=$block['DETAIL_TEXT']?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
