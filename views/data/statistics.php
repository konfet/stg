<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Statistics';
?>

<div class="col-lg-6">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'user_id',
                'label' => 'Actual amount of money',
                'value' => $model->user->activeMoney,                
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
            'money_received',
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
