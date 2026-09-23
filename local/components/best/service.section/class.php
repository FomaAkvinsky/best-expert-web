<?php

use Best\Content\Iblock;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class BestServiceSectionComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['IBLOCK_CODE'] = trim((string)($params['IBLOCK_CODE'] ?? 'best_services'));
        $params['CODE'] = trim((string)($params['CODE'] ?? ''));
        $params['CACHE_TIME'] = (int)($params['CACHE_TIME'] ?? 3600);

        return $params;
    }

    public function executeComponent()
    {
        if (!Loader::includeModule('iblock')) {
            ShowError('Модуль iblock не установлен.');
            return;
        }

        if ($this->arParams['CODE'] === '') {
            $this->set404();
            return;
        }

        try {
            if ($this->startResultCache()) {
                $this->arResult = $this->loadData();

                if (!$this->arResult['SECTION']) {
                    $this->abortResultCache();
                    $this->set404();
                    return;
                }

                $this->setResultCacheKeys(['SECTION', 'CHILD_SECTIONS']);
                $this->includeComponentTemplate();
            }

            $this->applyMeta();
        } catch (Throwable $e) {
            $this->abortResultCache();
            ShowError($e->getMessage());
        }
    }

    private function loadData(): array
    {
        $iblockId = Iblock::idByCode($this->arParams['IBLOCK_CODE']);

        $res = CIBlockSection::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            [
                'IBLOCK_ID' => $iblockId,
                'CODE' => $this->arParams['CODE'],
                'ACTIVE' => 'Y',
                'SECTION_ID' => false,
            ],
            false,
            [
                'ID',
                'IBLOCK_ID',
                'IBLOCK_SECTION_ID',
                'DEPTH_LEVEL',
                'NAME',
                'CODE',
                'DESCRIPTION',
                'DESCRIPTION_TYPE',
                'UF_*',
            ]
        );

        $section = $res->Fetch() ?: null;

        if (!$section) {
            return [
                'IBLOCK_ID' => $iblockId,
                'SECTION' => null,
                'CHILD_SECTIONS' => [],
            ];
        }

        $children = [];
        $childRes = CIBlockSection::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => (int)$section['ID'],
                'ACTIVE' => 'Y',
            ],
            false,
            ['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'CODE', 'SORT', 'DESCRIPTION', 'DESCRIPTION_TYPE']
        );

        while ($child = $childRes->Fetch()) {
            $children[] = $child;
        }

        return [
            'IBLOCK_ID' => $iblockId,
            'SECTION' => $section,
            'CHILD_SECTIONS' => $children,
        ];
    }

    private function applyMeta(): void
    {
        if (empty($this->arResult['SECTION'])) {
            return;
        }

        global $APPLICATION;

        $section = $this->arResult['SECTION'];
        $description = trim(strip_tags((string)($section['UF_HERO_SUBTITLE'] ?? $section['DESCRIPTION'] ?? '')));

        $APPLICATION->SetTitle((string)$section['NAME']);
        $APPLICATION->SetPageProperty('title', $section['NAME'] . ' | БЭСТ');

        if ($description !== '') {
            $APPLICATION->SetPageProperty('description', $description);
            $APPLICATION->SetPageProperty('og_description', $description);
        }

        $APPLICATION->SetPageProperty('og_title', $section['NAME'] . ' | БЭСТ');
        $APPLICATION->SetPageProperty(
            'canonical',
            'https://' . $_SERVER['HTTP_HOST'] . '/services/' . rawurlencode((string)$section['CODE']) . '/'
        );
    }

    private function set404(): void
    {
        global $APPLICATION;

        CHTTP::SetStatus('404 Not Found');
        @define('ERROR_404', 'Y');

        $APPLICATION->SetTitle('Страница не найдена');
        $APPLICATION->SetPageProperty('title', '404 Not Found');

        echo '<section class="my-5 py-5">';
        echo '<div class="container text-center" style="min-height:45vh">';
        echo '<div class="row justify-content-center"><div class="col-lg-10 col-xl-8">';
        echo '<p class="h1 text-dark text-center">404 Not Found</p>';
        echo '<p class="text-center">Извините, страница не найдена.</p>';
        echo '</div></div></div></section>';
    }
}
