<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Вещь
 *
 * @property int $id
 * @property int $archive_id
 * @property string $type
 * @property string $description
 * @property string $created_at
 *
 * @property-read Archive $archive
 * @see Thing::getArchive()
 * @property-read Photo[] $photos
 * @see Thing::getPhotos()
 */
class Thing extends \yii\db\ActiveRecord
{
    public const
        TYPE_SHOES = 'shoes',
        TYPE_CLOTHES = 'clothes',
        TYPE_LIST = [
            self::TYPE_SHOES,
            self::TYPE_CLOTHES,
        ],
        TYPE_LABELS = [
            self::TYPE_SHOES => 'Обувь',
            self::TYPE_CLOTHES => 'Одежда',
        ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'things';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archive_id'], 'integer'],
            [['type', 'name'], 'required'],
            [['type', 'name', 'description'], 'string', 'max' => 255],
            [['archive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archive::class, 'targetAttribute' => ['archive_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'archive_id' => 'Место хранения',
            'type' => 'Тип',
            'name' => 'Название',
            'description' => 'Описание',
            'archive.name' => 'Место хранения',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Место хранения
     *
     * @return ActiveQuery
     */
    public function getArchive(): ActiveQuery
    {
        return $this->hasOne(Archive::class, ['id' => 'archive_id']);
    }

    /**
     * Фото
     *
     * @return ActiveQuery
     */
    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, [
            'entity_id' => 'id',
            'entity_type' => PhotoEntity::TYPE_THING
        ]);
    }
}
