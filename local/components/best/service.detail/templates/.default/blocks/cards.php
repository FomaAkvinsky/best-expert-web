<?php
$props = $block['PROPERTIES'];
$items = (array)($props['ITEMS']['VALUE'] ?? []);
$descriptions = (array)($props['ITEMS']['DESCRIPTION'] ?? []);
$icons = (array)($props['ITEM_ICONS']['VALUE'] ?? []);
$layout = (int)($block['LAYOUT'] ?: 2);
$layout = in_array($layout, [1, 2, 3, 4], true) ? $layout : 2;
$col = [1 => 12, 2 => 6, 3 => 4, 4 => 3][$layout];

$eyebrow = trim((string)($props['EYEBROW']['VALUE'] ?? ''));
$intro = trim((string)($props['INTRO']['VALUE'] ?? ''));
$subtitle = trim((string)($props['SUBTITLE']['VALUE'] ?? ''));
$subintro = trim((string)($props['SUBINTRO']['VALUE'] ?? ''));
$view = (string)($block['VIEW'] ?? 'cards');
$blockCode = (string)($block['CODE'] ?? '');

$mainSectionClass = 'section section-lg bg-white';
$compactSectionClass = 'section pt-4 bg-white';
$compactColumnClass = 'col-xl-9 mt-5 wow fadeInUpSmall';

if ($blockCode === 'construction-tasks') {
    $mainSectionClass = 'section section-lg pb-0 bg-white';
}

if ($blockCode === 'construction-methods') {
    $compactSectionClass = 'section pt-0 bg-white';
    $compactColumnClass = 'col-xl-9 wow fadeInUpSmall';
}

if ($view === 'link-boxes-main'):
?>
<section class="<?=htmlspecialcharsbx($mainSectionClass)?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($eyebrow !== ''): ?><h6 class="wow fadeInUpSmall"><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                <h2 class="wow fadeInUpSmall" data-wow-delay=".1s"><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if ($intro !== ''): ?><p class="wow fadeInUpSmall" data-wow-delay=".2s"><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>
            </div>
        </div>

        <div class="row row-50">
            <div class="col-xl-9 wow fadeInUpSmall">
                <?php if ($subtitle !== ''): ?><h3 class="h4"><?=htmlspecialcharsbx($subtitle)?></h3><?php endif; ?>
                <?php if ($subintro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($subintro))?></p><?php endif; ?>

                <div class="row row-30">
                    <?php foreach ($items as $i => $title): ?>
                        <div class="col-12">
                            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
                                <?php if (!empty($icons[$i])): ?>
                                    <span class="icon link-box__icon <?=htmlspecialcharsbx((string)$icons[$i])?>"></span>
                                <?php endif; ?>
                                <div class="link-box__main">
                                    <h4><?=htmlspecialcharsbx((string)$title)?></h4>
                                    <?php if (!empty($descriptions[$i])): ?>
                                        <p><?=nl2br(htmlspecialcharsbx((string)$descriptions[$i]))?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ($view === 'link-boxes-compact'): ?>

<section class="<?=htmlspecialcharsbx($compactSectionClass)?>">
    <div class="container">
        <div class="row mb-5">
            <div class="<?=htmlspecialcharsbx($compactColumnClass)?>">
                <h3 class="h4"><?=htmlspecialcharsbx($block['NAME'])?></h3>
                <?php if ($intro !== ''): ?><p><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>

                <div class="row row-30">
                    <?php foreach ($items as $i => $title): ?>
                        <div class="col-12">
                            <a class="link-box" style="max-width:100%" href="#" onclick="return false;">
                                <?php if (!empty($icons[$i])): ?>
                                    <span class="icon link-box__icon <?=htmlspecialcharsbx((string)$icons[$i])?>"></span>
                                <?php endif; ?>
                                <div class="link-box__main">
                                    <h4><?=htmlspecialcharsbx((string)$title)?></h4>
                                    <?php if (!empty($descriptions[$i])): ?>
                                        <p><?=nl2br(htmlspecialcharsbx((string)$descriptions[$i]))?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($block['DETAIL_TEXT'])): ?>
                    <div class="mt-4"><?=$block['DETAIL_TEXT']?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php else: ?>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($eyebrow !== ''): ?><h6 class="wow fadeInUpSmall"><?=htmlspecialcharsbx($eyebrow)?></h6><?php endif; ?>
                <h2 class="wow fadeInUpSmall" data-wow-delay=".1s"><?=htmlspecialcharsbx($block['NAME'])?></h2>
                <?php if ($intro !== ''): ?><p class="wow fadeInUpSmall" data-wow-delay=".2s"><?=nl2br(htmlspecialcharsbx($intro))?></p><?php endif; ?>
            </div>
        </div>

        <div class="row row-30 justify-content-center">
            <?php foreach ($items as $i => $title): ?>
                <div class="col-md-10 col-lg-<?=$col?> wow fadeInUpSmall">
                    <div class="services-divider__card h-100">
                        <h3 class="h5 mb-3"><?=htmlspecialcharsbx((string)$title)?></h3>
                        <?php if (!empty($descriptions[$i])): ?>
                            <p><?=nl2br(htmlspecialcharsbx((string)$descriptions[$i]))?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($block['DETAIL_TEXT'])): ?>
            <div class="row justify-content-center mt-4">
                <div class="col-md-10 col-lg-9"><?=$block['DETAIL_TEXT']?></div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
