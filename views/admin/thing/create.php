<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Thing;

/* @var $this View */
/* @var $model Thing */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Вещи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
