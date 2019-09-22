<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Фото
 *
 * Class Photo
 * @package app\models
 *
 * @property int $id
 * @property string $entity_type
 * @property int $entity_id
 * @property string $url
 * @property string $path
 * @property int $sort
 * @property string $created_at
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_type', 'entity_id', 'url', 'sort', 'created_at'], 'required'],
            [['entity_id', 'sort'], 'integer'],
            [['entity_type', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_type' => 'Тип объекта',
            'entity_id' => 'ID объекта',
            'url' => 'Ссылка',
            'path' => 'Путь',
            'sort' => 'Сортировка',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Объект на фото
     *
     * @return null|ActiveQuery
     */
    public function getEntity()
    {
        if (!PhotoEntity::isTypeExists($this->entity_type)) {
            return null;
        }

        return $this->hasOne(
            PhotoEntity::getClassByType($this->entity_type),
            ['id' => 'entity_id']
        );
    }
}
