<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $record app\models\Records */
/* @var $relativeUrlToImage */



$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="records-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $record->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $record->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $record,
        'attributes' => [
            'heading',
            'author_name',
            'text:ntext',
            'date_of_creation:datetime',
        ],
    ]) ?>

    <?php
    if ($relativeUrlToImage != false) {
        echo $this->render('_renderImg', [
            'relativeUrlToImage' => $relativeUrlToImage
        ]);
    }
    ?>

</div>
