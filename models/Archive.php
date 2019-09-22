<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Место хранения
 *
 * Class Archive
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 *
 * @property Thing[] $things
 * @see Archive::getThings()
 */
class Archive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archives';
    }

    /**
     * Список мест хранения
     *
     * @return array
     */
    public static function getList()
    {
        return static::find()->select('name')->indexBy('id')->column();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Вещь
     *
     * @return ActiveQuery
     */
    public function getThings()
    {
        return $this->hasMany(Thing::class, ['archive_id' => 'id']);
    }

    /**
     * Фото
     *
     * @return ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::class, [
            'entity_id' => 'id',
            'entity_type' => PhotoEntity::TYPE_ARCHIVE
        ]);
    }
}
