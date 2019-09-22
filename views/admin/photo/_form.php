<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\Photo;
use app\models\PhotoEntity;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this View */
/* @var $model Photo */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'entity_type')
            ->dropDownList(PhotoEntity::TYPE_LABELS, ['prompt' => '', 'id' => 'entity-type']) ?>
        <?= $form->field($model, 'entity_id')
            ->widget(DepDrop::class, [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'depends'=>['entity-type'],
                        'placeholder' => '',
                        'url' => Url::to(['entity-list'])
                    ]
                ]
            )
        ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
