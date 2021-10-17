<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Prize n.' . $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="col-lg-6">
    <?php 
        if ($model->user_id != \Yii::$app->user->getId()) {
            echo "<h1>Unauthorized access!</h1>";
            return;
        } 
     ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php 
            if ($model->showButton('transfer')) {
                echo Html::a('Transfer', ['transfer', 'id' => $model->id], ['class' => 'btn btn-primary']).'&nbsp;'.'&nbsp;';
            } 
            if ($model->showButton('convert')) {
                echo Html::a('Convert', ['convert', 'id' => $model->id], ['class' => 'btn btn-info']).'&nbsp;'.'&nbsp;';
            } 
            if ($model->showButton('refuse')) {
                echo Html::a('Refuse', ['refuse', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                    'confirm' => 'Are you sure you want to refuse?',
                    'method' => 'post',
                   ],
                ]);
            }            
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view', /*'style'=>'width: 20%;'*/],
        'attributes' => [
            'id',
            'type',
            'status',            
            'value',
            [
                'attribute' => 'item.name',                
            ],                        
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'contentOptions' => ['style'=>'width: 75%;'],
            ],            
            'comment',
        ],
    ]) ?>
    
    
  
</div>
