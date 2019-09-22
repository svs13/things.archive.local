<?php

use yii\db\Migration;

/**
 * Добавление таблицы archives "Архивы"
 *
 * Class m190922_115352_create_archives_table
 */
class m190922_115352_create_archives_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('archives', [
            'id' => $this->primaryKey()->unsigned(),
            'description' => $this->string(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('archives');
    }
}
