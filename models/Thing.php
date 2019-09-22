<?php

namespace app\models;

/**
 * Вещь
 *
 * @property int $id
 * @property int $archive_id
 * @property string $type
 * @property string $description
 *
 * @property Archive $archive
 * @see Thing::getArchive()
 */
class Thing extends \yii\db\ActiveRecord
{
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
            [['type'], 'required'],
            [['type', 'description'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'description' => 'Description',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Хранилище
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchive()
    {
        return $this->hasOne(Archive::className(), ['id' => 'archive_id']);
    }
}
