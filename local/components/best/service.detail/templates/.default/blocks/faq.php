<?php
$props = $block['PROPERTIES'];
$questions = (array)($props['ITEMS']['VALUE'] ?? []);
$answers = (array)($props['FAQ_ANSWERS']['VALUE'] ?? []);

if (!$answers) {
    $answers = (array)($props['ITEMS']['DESCRIPTION'] ?? []);
}

$accordionId = 'accordion-best-' . (int)$block['ID'];

$sectionClass = bestServiceBlockClass($block, 'SECTION_CLASS', 'section section-lg bg-gray-100');
$containerClass = bestServiceBlockClass($block, 'CONTAINER_CLASS', 'container');
$contentRowClass = bestServiceBlockClass($block, 'CONTENT_ROW_CLASS', 'row row-40 justify-content-center');
$titleClass = bestServiceBlockClass($block, 'TITLE_CLASS', '');
?>
<section class="<?=htmlspecialcharsbx($sectionClass)?>">
    <div class="<?=htmlspecialcharsbx($containerClass)?>">
        <div class="<?=htmlspecialcharsbx($contentRowClass)?>">
            <div class="col-md-10 col-lg-6 wow fadeInUpSmall">
                <h3<?php if ($titleClass !== ''): ?> class="<?=htmlspecialcharsbx($titleClass)?>"<?php endif; ?>><?=htmlspecialcharsbx($block['NAME'])?></h3>
                <div class="divider-modern"></div>
                <?php if (!empty($props['INTRO']['VALUE'])): ?>
                    <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
                <?php endif; ?>
            </div>

            <div class="col-md-10 col-lg-6 wow fadeInUpSmall" data-wow-delay=".08s">
                <div class="card-group-custom card-group-line" id="<?=$accordionId?>" role="tablist" aria-multiselectable="true">
                    <?php foreach ($questions as $i => $question): ?>
                        <?php $itemId = $accordionId . '-' . $i; ?>
                        <article class="card card-custom card-line">
                            <div class="card-header" id="<?=$itemId?>-heading" role="tab">
                                <div class="card-title">
                                    <a class="collapsed" role="button" data-toggle="collapse"
                                       data-parent="#<?=$accordionId?>" data-target="#<?=$itemId?>"
                                       href="#" onclick="return false;" aria-expanded="false">
                                        <?=htmlspecialcharsbx((string)$question)?>
                                        <div class="card-arrow"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="collapse" id="<?=$itemId?>" role="tabpanel" aria-labelledby="<?=$itemId?>-heading">
                                <div class="card-body">
                                    <p><?=nl2br(htmlspecialcharsbx((string)($answers[$i] ?? '')))?></p>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
