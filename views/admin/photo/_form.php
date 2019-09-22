<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\Photo;

/* @var $this View */
/* @var $model Photo */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'entity_type')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'entity_id')->textInput() ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')->textInput() ?>
        <?= $form->field($model, 'created_at')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
