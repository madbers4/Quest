<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $record app\models\Records */

$this->title = 'Изменить запись: ';
$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $record->id, 'url' => ['view', 'id' => $record->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="records-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $record,
        'UploadImg' => $UploadImg
    ]) ?>

</div>
