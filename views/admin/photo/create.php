<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Photo;

/* @var $this View */
/* @var $model Photo */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Фото', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
