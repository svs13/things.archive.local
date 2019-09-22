<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Photo;

/**
 * Поиск фото
 *
 * Class PhotoSearch
 * @package app\models\search
 */
class PhotoSearch extends Photo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'sort'], 'integer'],
            [['entity_type', 'url', 'created_at'], 'safe'],
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
        $query = Photo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'entity_type', $this->entity_type])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
