<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MskTemplatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prizes';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            //echo Html::a('Create', ['create'], ['class' => 'btn btn-success']);
            /*echo debug($searchModel);
            echo Html::a('Export', ['export', 'MskTemplatesSearch' => $searchModel->toArray()], ['class' => 'btn btn-warning']);*/
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',                
                'contentOptions'=>[ 'style'=>'width: 5%'],
            ],            
            [
                'attribute' => 'type',                
                'contentOptions'=>[ 'style'=>'width: 10%'],             
            ],
            [
                'attribute' => 'value',
                'contentOptions'=>[ 'style'=>'width: 10%'],
            ],
            [
                'attribute' => 'status',
                'contentOptions'=>[ 'style'=>'width: 10%'],
            ],
            [
                'attribute' => 'item.name',                
                'contentOptions'=>[ 'style'=>'width: 20%'],
            ],            
            [
                'attribute' => 'comment',
                'contentOptions'=>[ 'style'=>'width: 25%'],
            ],                        
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'contentOptions'=>[ 'style'=>'width: 8%'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'contentOptions'=>[ 'style'=>'width: 8%'],
            ],
  
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'contentOptions'=>[ 'style'=>'width: 5%']],
        ],
    ]); ?>


</div>
