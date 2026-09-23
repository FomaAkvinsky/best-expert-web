<?php

use Best\Content\Iblock;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class BestDocumentListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($params)
    {
        $params['IBLOCK_CODE'] = trim((string)($params['IBLOCK_CODE'] ?? 'best_documents'));
        $params['DOC_TYPES'] = array_values(array_filter((array)($params['DOC_TYPES'] ?? [])));
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
        ];

        if ($this->arParams['DOC_TYPES']) {
            $filter['PROPERTY_DOC_TYPE'] = $this->arParams['DOC_TYPES'];
        }

        $items = [];
        $res = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            $filter,
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PREVIEW_TEXT']
        );

        while ($element = $res->GetNextElement()) {
            $fields = $element->GetFields();
            $fields['PROPERTIES'] = $element->GetProperties();
            $items[] = $fields;
        }

        return [
            'IBLOCK_ID' => $iblockId,
            'ITEMS' => $items,
        ];
    }
}
