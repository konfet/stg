<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Statistics';
?>

<div class="col-lg-12">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user_id',
                'label' => 'Actual amount of money',
                'value' => $model->user->activeMoney,   
                'contentOptions' => ['style'=>'width: 80%;'],
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Actual amount of bonuses',
                'value' => $model->user->activeBonuses,                
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Actual amount of gifts',
                'value' => $model->user->activeGifts,
            ],
        ],
    ]) ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'money_received',
                //'label' => 'Actual amount of bonuses',
                //'value' => $model->user->activeBonuses,                
                'contentOptions' => ['style'=>'width: 80%;'],
            ],
            
            'money_transferred',
            'money_converted_to_bonuses',
            'bonuses_received',
            'bonuses_converted_from_money',
            'bonuses_transferred',
            'items_received',
            'items_sent',
        ],
    ]) ?>

</div>
