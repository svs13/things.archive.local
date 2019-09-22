<?php

namespace app\models;

/**
 * Хранилище
 *
 * Class Archive
 * @package app\models
 *
 * @property int $id
 * @property string $description
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Вещь
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThings()
    {
        return $this->hasMany(Thing::className(), ['archive_id' => 'id']);
    }
}
