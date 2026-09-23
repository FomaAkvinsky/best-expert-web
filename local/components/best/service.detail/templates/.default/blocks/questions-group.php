<?php
$first = $questionBlocks[0];
$firstProps = $first['PROPERTIES'];

$eyebrow = trim((string)($firstProps['EYEBROW']['VALUE'] ?? ''));
$groupTitle = trim((string)($firstProps['SUBTITLE']['VALUE'] ?? ''));
$intro = trim((string)($firstProps['INTRO']['VALUE'] ?? ''));
?>

<section class="section section-lg bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center">
                <?php if ($eyebrow !== ''): ?>
                    <h6 class="wow fadeInUpSmall"><?=htmlspecialcharsbx($eyebrow)?></h6>
                <?php endif; ?>

                <?php if ($groupTitle !== ''): ?>
                    <h2 class="wow fadeInUpSmall" data-wow-delay=".1s"><?=htmlspecialcharsbx($groupTitle)?></h2>
                <?php endif; ?>

                <?php if ($intro !== ''): ?>
                    <p class="wow fadeInUpSmall" data-wow-delay=".2s"><?=nl2br(htmlspecialcharsbx($intro))?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row row-30 justify-content-center">
            <?php foreach ($questionBlocks as $index => $questionBlock): ?>
                <?php
                $props = $questionBlock['PROPERTIES'];
                $items = (array)($props['ITEMS']['VALUE'] ?? []);
                $delay = $index === 0 ? '' : ' data-wow-delay="' . htmlspecialcharsbx(number_format(min($index * 0.04, 0.16), 2)) . 's"';
                ?>
                <div class="col-md-10 col-lg-6 wow fadeInUpSmall"<?=$delay?>>
                    <div class="services-divider__card h-100">
                        <h3 class="h5 mb-3"><?=htmlspecialcharsbx($questionBlock['NAME'])?></h3>
                        <ul class="list-marked">
                            <?php foreach ($items as $item): ?>
                                <li><?=htmlspecialcharsbx((string)$item)?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
