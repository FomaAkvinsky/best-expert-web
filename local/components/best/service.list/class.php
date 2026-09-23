<?php

use Best\Content\Iblock;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class BestServiceListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['IBLOCK_CODE'] = trim((string)($params['IBLOCK_CODE'] ?? 'best_services'));
        $params['SECTION_CODE'] = trim((string)($params['SECTION_CODE'] ?? ''));
        $params['CACHE_TIME'] = (int)($params['CACHE_TIME'] ?? 3600);

        return $params;
    }

    public function executeComponent()
    {
        if (!Loader::includeModule('iblock')) {
            ShowError('Модуль iblock не установлен.');
            return;
        }

        try {
            if ($this->startResultCache()) {
                $this->arResult = $this->loadItems();
                $this->includeComponentTemplate();
            }
        } catch (Throwable $e) {
            $this->abortResultCache();
            ShowError($e->getMessage());
        }
    }

    private function loadItems(): array
    {
        $iblockId = Iblock::idByCode($this->arParams['IBLOCK_CODE']);
        $filter = [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
            'ACTIVE_DATE' => 'Y',
        ];

        if ($this->arParams['SECTION_CODE'] !== '') {
            $sectionId = Iblock::sectionIdByCode($iblockId, $this->arParams['SECTION_CODE']);
            if (!$sectionId) {
                throw new SystemException('Раздел услуг не найден: ' . $this->arParams['SECTION_CODE']);
            }
            $filter['SECTION_ID'] = $sectionId;
            $filter['INCLUDE_SUBSECTIONS'] = 'Y';
        }

        $result = [
            'IBLOCK_ID' => $iblockId,
            'ITEMS' => [],
        ];

        $res = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            $filter,
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'SORT', 'PREVIEW_TEXT', 'DETAIL_PAGE_URL', 'PROPERTY_ICON']
        );

        while ($row = $res->GetNext()) {
            $result['ITEMS'][] = $row;
        }

        return $result;
    }
}
