<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecordsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="records-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'heading') ?>

    <?= $form->field($model, 'author_name') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'date_of_creation') ?>

    <?php // echo $form->field($model, 'img_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
