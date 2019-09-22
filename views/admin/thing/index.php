<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use app\models\search\ThingSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use app\models\Thing;

/* @var $this View */
/* @var $searchModel ThingSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Вещи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        return Thing::TYPE_LABELS[$model->type] ?? '';
                    },
                ],
                'name',
                'description',
                [
                    'attribute' => 'archive.name',
                    'value' => function (Thing $model) {
                        if (empty($model->archive)) {
                            return '';
                        }

                        return Html::a(
                            Html::encode($model->archive->name),
                            ['/admin/archive/update', 'id' => $model->archive->id]
                        );
                    },
                    'format' => 'raw'
                ],
                'created_at',
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
