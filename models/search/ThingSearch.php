<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Thing;

/**
 * Поиск вещи
 *
 * Class ArchiveSearch
 * @package app\models\search
 */
class ThingSearch extends Thing
{
    public $archiveName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'archive_id'], 'integer'],
            [['name', 'archiveName', 'type', 'description', 'created_at'], 'safe'],
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
        $query = Thing::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'archive_id' => $this->archive_id,
            'created_at' => $this->created_at,
        ]);

        if (!empty($this->type)) {
            $query
                ->filterWhere(['like', 'type', $this->type]);
        }

        if (!empty($this->name)) {
            $query->filterWhere(['like', 'name', $this->name]);
        }

        return $dataProvider;
    }
}
