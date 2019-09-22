<?php

use yii\db\Migration;

/**
 * Добавление таблицы photos "Фотографии"
 *
 * Class m190922_121549_create_photos_table
 */
class m190922_121549_create_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photos}}', [
            'id' => $this->primaryKey()->unsigned(),
            'entity_type' => $this->string()->notNull(),
            'entity_id' => $this->integer()->unsigned()->notNull(),
            'url' => $this->string()->notNull(),
            'path' => $this->string()->notNull(),
            'sort' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            'idx-photos-entity_type-entity_id',
            'photos',
            ['entity_type', 'entity_id']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-photos-entity_type-entity_id',
            'photos'
        );
        $this->dropTable('{{%photos}}');
    }
}
