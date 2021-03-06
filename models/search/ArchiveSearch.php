<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Archive;

/**
 * Поиск места хранения
 *
 * Class ArchiveSearch
 * @package app\models\search
 */
class ArchiveSearch extends Archive
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'description', 'created_at'], 'safe'],
        ];
    }

    /**
     * Поставщик данных
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Archive::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
