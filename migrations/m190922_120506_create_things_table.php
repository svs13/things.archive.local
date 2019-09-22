<?php

use yii\db\Migration;

/**
 * Добавление таблицы things "Вещи"
 *
 * Class m190922_120506_create_things_table
 */
class m190922_120506_create_things_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%things}}', [
            'id' => $this->primaryKey()->unsigned(),
            'archive_id' => $this->integer()->unsigned(),
            'type' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $this->createIndex(
            '{{%idx-things-archive_id}}',
            '{{%things}}',
            'archive_id'
        );

        $this->addForeignKey(
            '{{%fk-things-archive_id}}',
            '{{%things}}',
            'archive_id',
            '{{%archives}}',
            'id',
            'RESTRICT' //запрет удаления, если есть связанные данные
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-things-archive_id}}',
            '{{%things}}'
        );

        $this->dropIndex(
            '{{%idx-things-archive_id}}',
            '{{%things}}'
        );

        $this->dropTable('{{%things}}');
    }
}
