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
            'id' => $this->primaryKey(),
            'archive_id' => $this->integer(),
            'type' => $this->string()->notNull(),
            'description' => $this->string(),
        ]);

        $this->createIndex(
            '{{%idx-things-archive_id}}',
            '{{%things}}',
            'archive_id'
        );

        // add foreign key for table `{{%archives}}`
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
        // drops foreign key for table `{{%archives}}`
        $this->dropForeignKey(
            '{{%fk-things-archive_id}}',
            '{{%things}}'
        );

        // drops index for column `archive_id`
        $this->dropIndex(
            '{{%idx-things-archive_id}}',
            '{{%things}}'
        );

        $this->dropTable('{{%things}}');
    }
}
