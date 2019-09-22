<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use app\models\search\ArchiveSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;

/* @var $this View */
/* @var $searchModel ArchiveSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Архивы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать архив', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'description',
                'created_at',
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>

    <?php Pjax::end(); ?>
</div>
