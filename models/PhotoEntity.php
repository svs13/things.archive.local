<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Объект на фото
 *
 * Class PhotoEntity
 * @package app\models
 */
class PhotoEntity
{
    public const
        TYPE_ARCHIVE = 'archive',
        TYPE_THING = 'thing',
        TYPE_LIST = [
            self::TYPE_ARCHIVE,
            self::TYPE_THING,
        ],
        TYPE_CLASSES = [
            self::TYPE_ARCHIVE => Archive::class,
            self::TYPE_THING => Thing::class,
        ],
        TYPE_LABELS = [
            self::TYPE_ARCHIVE  => 'Место хранения',
            self::TYPE_THING    => 'Вещь',
        ];

    /**
     * Класс по типу сущности
     *
     * @param string $type
     * @return null|Archive|Thing
     */
    public static function getClassByType(string $type): ?string
    {
        if (!static::isTypeExists($type)) {
            return null;
        }

        return static::TYPE_CLASSES[$type];
    }

    /**
     * Есть ли заданный тип сущности
     *
     * @param string $type
     * @return bool
     */
    public static function isTypeExists(string $type): bool
    {
        return in_array($type, static::TYPE_LIST);
    }

    /**
     * Запрос к таблице сущности
     *
     * @param string $type
     * @return null|ActiveQuery
     */
    public static function getEntityActiveQuery(string $type): ?ActiveQuery
    {
        if (!static::isTypeExists($type)) {
            return null;
        }

        $class = static::getClassByType($type);

        return $class::find();
    }

    /**
     * Список сущностей заданного типа
     *
     * @param string $type
     * @return array
     */
    public static function getEntityListByType(string $type): array
    {
        $query = static::getEntityActiveQuery($type);

        if (empty($query)) {
            return [];
        }

        return $query->select('name')->indexBy('id')->column();
    }
}