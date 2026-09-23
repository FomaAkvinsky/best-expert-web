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

        $number = trim((string)($properties['NUMBER']['VALUE'] ?? ''));
        $issuer = trim((string)($properties['ISSUER']['VALUE'] ?? ''));
        $issueDate = trim((string)($properties['ISSUE_DATE']['VALUE'] ?? ''));
        $validFrom = trim((string)($properties['VALID_FROM']['VALUE'] ?? ''));
        $validTo = trim((string)($properties['VALID_TO']['VALUE'] ?? ''));
        ?>
        <div class="col-md-6">
            <article class="services-divider__card h-100 wow fadeInUpSmall">
                <h3 class="h5 mb-3"><?=htmlspecialcharsbx($item['NAME'])?></h3>

                <?php if (!empty($item['PREVIEW_TEXT'])): ?>
                    <p><?=$item['PREVIEW_TEXT']?></p>
                <?php endif; ?>

                <dl class="list-terms-medium mt-3">
                    <?php if ($number !== ''): ?>
                        <div class="mb-2">
                            <dt>Номер</dt>
                            <dd><?=htmlspecialcharsbx($number)?></dd>
                        </div>
                    <?php endif; ?>

                    <?php if ($issuer !== ''): ?>
                        <div class="mb-2">
                            <dt>Организация</dt>
                            <dd><?=htmlspecialcharsbx($issuer)?></dd>
                        </div>
                    <?php endif; ?>

                    <?php if ($issueDate !== ''): ?>
                        <div class="mb-2">
                            <dt>Дата</dt>
                            <dd><?=htmlspecialcharsbx($issueDate)?></dd>
                        </div>
                    <?php endif; ?>

                    <?php if ($validFrom !== '' || $validTo !== ''): ?>
                        <div class="mb-2">
                            <dt>Срок действия</dt>
                            <dd>
                                <?=htmlspecialcharsbx($validFrom)?>
                                <?php if ($validFrom !== '' && $validTo !== ''): ?> — <?php endif; ?>
                                <?=htmlspecialcharsbx($validTo)?>
                            </dd>
                        </div>
                    <?php endif; ?>
                </dl>

                <?php if (!empty($item['DETAIL_TEXT'])): ?>
                    <div class="mt-3"><?=$item['DETAIL_TEXT']?></div>
                <?php endif; ?>

                <?php if ($fileUrl || $externalUrl): ?>
                    <div class="mt-4">
                        <?php if ($fileUrl): ?>
                            <a class="button button-sm button-primary"
                               href="<?=htmlspecialcharsbx($fileUrl)?>"
                               target="_blank"
                               rel="noopener">Открыть документ</a>
                        <?php endif; ?>

                        <?php if ($externalUrl): ?>
                            <a class="button button-sm button-default-outline"
                               href="<?=htmlspecialcharsbx($externalUrl)?>"
                               target="_blank"
                               rel="noopener">Проверить в реестре</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </article>
        </div>
    <?php endforeach; ?>
</div>
