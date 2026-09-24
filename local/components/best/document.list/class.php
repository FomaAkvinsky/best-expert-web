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
        $params['DOC_TYPES'] = array_values(array_filter(array_map(
            static fn($value) => trim((string)$value),
            (array)($params['DOC_TYPES'] ?? [])
        )));
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
            $enumIds = $this->resolveDocumentTypeIds($iblockId, $this->arParams['DOC_TYPES']);

            if (!$enumIds) {
                return [
                    'IBLOCK_ID' => $iblockId,
                    'ITEMS' => [],
                ];
            }

            $filter['PROPERTY_DOC_TYPE'] = $enumIds;
        }

        $items = [];
        $res = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'NAME' => 'ASC'],
            $filter,
            false,
            false,
            ['ID', 'IBLOCK_ID', 'NAME', 'CODE', 'SORT', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PREVIEW_TEXT_TYPE', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE']
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

    private function resolveDocumentTypeIds(int $iblockId, array $xmlIds): array
    {
        $property = CIBlockProperty::GetList(
            ['ID' => 'ASC'],
            [
                'IBLOCK_ID' => $iblockId,
                'CODE' => 'DOC_TYPE',
            ]
        )->Fetch();

        if (!$property) {
            return [];
        }

        $ids = [];
        foreach ($xmlIds as $xmlId) {
            $res = CIBlockPropertyEnum::GetList(
                ['SORT' => 'ASC'],
                [
                    'PROPERTY_ID' => (int)$property['ID'],
                    'XML_ID' => $xmlId,
                ]
            );

            if ($row = $res->Fetch()) {
                $ids[] = (int)$row['ID'];
            }
        }

        return array_values(array_unique($ids));
    }
}
