<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\Thing;
use app\models\Archive;

/* @var $this View */
/* @var $model Thing */
?>

<div class="thing-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'archive_id')
            ->dropDownList(Archive::getList(), ['prompt' => '']) ?>
        <?= $form->field($model, 'type')
            ->dropDownList(Thing::TYPE_LABELS, ['prompt' => '']) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
