<?php


/* @var $this yii\web\View */
/* @var $record app\models\Records */
/* @var $UploadImg app\models\UploadForm */

$this->title = 'Create Records';
$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="records-create">

    <?= $this->render('_form', [
        'model' => $record,
        'UploadImg' => $UploadImg
    ]) ?>


</div>
