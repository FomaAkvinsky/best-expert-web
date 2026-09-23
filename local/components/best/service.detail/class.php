<?php

use Best\Content\Iblock;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class BestServiceDetailComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['IBLOCK_CODE'] = trim((string)($params['IBLOCK_CODE'] ?? 'best_services'));
        $params['BLOCKS_IBLOCK_CODE'] = trim((string)($params['BLOCKS_IBLOCK_CODE'] ?? 'best_service_blocks'));
        $params['SECTION_CODE'] = trim((string)($params['SECTION_CODE'] ?? ''));
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

        if ($this->arParams['SECTION_CODE'] === '' || $this->arParams['CODE'] === '') {
            $this->set404();
            return;
        }

        try {
            if ($this->startResultCache()) {
                $this->arResult = $this->loadData();

                if (!$this->arResult['SERVICE'] || !$this->arResult['SECTION']) {
                    $this->abortResultCache();
                    $this->set404();
                    return;
                }

                $this->setResultCacheKeys(['SERVICE', 'SECTION']);
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
        $serviceIblockId = Iblock::idByCode($this->arParams['IBLOCK_CODE']);
        $blocksIblockId = Iblock::idByCode($this->arParams['BLOCKS_IBLOCK_CODE']);

        $sectionRes = CIBlockSection::GetList(
            [],
            [
                'IBLOCK_ID' => $serviceIblockId,
                'CODE' => $this->arParams['SECTION_CODE'],
                'ACTIVE' => 'Y',
            ],
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE']
        );

        $section = $sectionRes->Fetch() ?: null;

        if (!$section) {
            return ['SERVICE' => null, 'SECTION' => null, 'BLOCKS' => []];
        }

        $service = null;
        $res = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $serviceIblockId,
                'SECTION_ID' => (int)$section['ID'],
                'INCLUDE_SUBSECTIONS' => 'N',
                'CODE' => $this->arParams['CODE'],
                'ACTIVE' => 'Y',
                'ACTIVE_DATE' => 'Y',
            ],
            false,
            ['nTopCount' => 1],
            ['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'NAME', 'CODE', 'PREVIEW_TEXT', 'DETAIL_TEXT']
        );

        if ($element = $res->GetNextElement()) {
            $service = $element->GetFields();
            $service['PROPERTIES'] = $element->GetProperties();
        }

        if (!$service) {
            return ['SERVICE' => null, 'SECTION' => $section, 'BLOCKS' => []];
        }

        $blocks = [];
        $blockRes = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            [
                'IBLOCK_ID' => $blocksIblockId,
                'ACTIVE' => 'Y',
                'PROPERTY_SERVICE' => (int)$service['ID'],
            ],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'SORT', 'PREVIEW_TEXT', 'DETAIL_TEXT']
        );

        while ($blockElement = $blockRes->GetNextElement()) {
            $block = $blockElement->GetFields();
            $block['PROPERTIES'] = $blockElement->GetProperties();
            $block['TYPE'] = $this->listXmlId($block['PROPERTIES']['BLOCK_TYPE'] ?? []);
            $block['LAYOUT'] = $this->listXmlId($block['PROPERTIES']['LAYOUT'] ?? []);
            $block['DOCUMENT_ITEMS'] = $this->loadDocuments($block['PROPERTIES']['DOCUMENTS']['VALUE'] ?? []);
            $blocks[] = $block;
        }

        return [
            'SERVICE' => $service,
            'SECTION' => $section,
            'BLOCKS' => $blocks,
        ];
    }

    private function loadDocuments($ids): array
    {
        $ids = array_values(array_filter(array_map('intval', (array)$ids)));
        if (!$ids) {
            return [];
        }

        $documents = [];
        $res = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            ['ID' => $ids, 'ACTIVE' => 'Y'],
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PREVIEW_TEXT']
        );

        while ($element = $res->GetNextElement()) {
            $document = $element->GetFields();
            $document['PROPERTIES'] = $element->GetProperties();
            $documents[] = $document;
        }

        return $documents;
    }

    private function listXmlId(array $property): string
    {
        $enumId = $property['VALUE_ENUM_ID'] ?? null;
        if (is_array($enumId)) {
            $enumId = reset($enumId);
        }

        if (!$enumId) {
            return '';
        }

        $enum = CIBlockPropertyEnum::GetByID((int)$enumId);
        return $enum ? (string)$enum['XML_ID'] : '';
    }

    private function applyMeta(): void
    {
        if (empty($this->arResult['SERVICE']) || empty($this->arResult['SECTION'])) {
            return;
        }

        global $APPLICATION;

        $service = $this->arResult['SERVICE'];
        $section = $this->arResult['SECTION'];
        $props = $service['PROPERTIES'];

        $title = Iblock::scalarProperty($props['SEO_TITLE'] ?? []) ?: $service['NAME'] . ' | БЭСТ';
        $description = Iblock::scalarProperty($props['SEO_DESCRIPTION'] ?? []);
        $ogTitle = Iblock::scalarProperty($props['OG_TITLE'] ?? []) ?: $title;
        $ogDescription = Iblock::scalarProperty($props['OG_DESCRIPTION'] ?? []) ?: $description;

        $APPLICATION->SetTitle((string)$service['NAME']);
        $APPLICATION->SetPageProperty('title', $title);

        if ($description !== '') {
            $APPLICATION->SetPageProperty('description', $description);
        }

        $APPLICATION->SetPageProperty('og_title', $ogTitle);
        $APPLICATION->SetPageProperty('og_description', $ogDescription);
        $APPLICATION->SetPageProperty(
            'canonical',
            'https://' . $_SERVER['HTTP_HOST']
            . '/services/' . rawurlencode((string)$section['CODE'])
            . '/' . rawurlencode((string)$service['CODE']) . '/'
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
