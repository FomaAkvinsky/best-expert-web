<?php
$props = $block['PROPERTIES'];
$questions = (array)($props['ITEMS']['VALUE'] ?? []);
$answers = (array)($props['ITEMS']['DESCRIPTION'] ?? []);
$accordionId = 'accordion-best-' . (int)$block['ID'];
?>
<section class="section section-lg bg-gray-100">
    <div class="container">
        <div class="row row-40 justify-content-center">
            <div class="col-md-10 col-lg-5">
                <h3><?=htmlspecialcharsbx($block['NAME'])?></h3>
                <div class="divider-modern"></div>
                <?php if (!empty($props['INTRO']['VALUE'])): ?>
                    <p><?=nl2br(htmlspecialcharsbx((string)$props['INTRO']['VALUE']))?></p>
                <?php endif; ?>
            </div>

            <div class="col-md-10 col-lg-7">
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
