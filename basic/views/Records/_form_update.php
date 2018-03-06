<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Records */
/* @var $form yii\widgets\ActiveForm */
/* @var $UploadImg app\models\UploadForm */

?>

<div class="records-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'heading')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 12]) ?>

    <?= $form->field($model, 'date_of_creation')->textarea(['rows' => 12]) ?>


    <?= $form->field($UploadImg, 'imageFile')->fileInput(['class' => 'btn btn-default']) ?>

    <div class="checkbox">
        <label><input type="checkbox" value="1" name="do_i_need_to_delete_a_photo">Удалить изображение (если Вы загружаете новое, то старое будет заменено)</label>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>


</div>
