<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Photo;

/* @var $this View */
/* @var $model Photo */

$this->title = 'Редактировать: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Фото', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
