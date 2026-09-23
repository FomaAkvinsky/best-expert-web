<?php

namespace Best\Content;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;

final class Iblock
{
    public static function idByCode(string $code): int
    {
        if (!Loader::includeModule('iblock')) {
            throw new SystemException('Bitrix module "iblock" is not available.');
        }

        $code = trim($code);
        if ($code === '') {
            throw new ArgumentException('IBlock code must not be empty.', 'code');
        }

        $res = \CIBlock::GetList(
            ['ID' => 'ASC'],
            ['CODE' => $code, 'CHECK_PERMISSIONS' => 'N']
        );

        if ($row = $res->Fetch()) {
            return (int)$row['ID'];
        }

        throw new SystemException(sprintf('IBlock with code "%s" was not found.', $code));
    }

    public static function sectionIdByCode(int $iblockId, string $code): ?int
    {
        $code = trim($code);
        if ($code === '') {
            return null;
        }

        $res = \CIBlockSection::GetList(
            ['ID' => 'ASC'],
            ['IBLOCK_ID' => $iblockId, 'CODE' => $code],
            false,
            ['ID']
        );

        if ($row = $res->Fetch()) {
            return (int)$row['ID'];
        }

        return null;
    }

    public static function scalarProperty(array $property): string
    {
        $value = $property['VALUE'] ?? '';

        if (is_array($value)) {
            $value = reset($value);
        }

        return is_scalar($value) ? trim((string)$value) : '';
    }
}
