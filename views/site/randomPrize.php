<?php

/* @var $this yii\web\View */

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Congratulations!';
?>
<div class="site-about">
        <?php if(Yii::$app->session->hasFlash('message')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>                                    
                    <p><?= Yii::$app->session->getFlash('message'); ?></p>
                    </div>    
        <?php endif; ?>                    
    
    <h1><?= Html::encode($this->title) ?></h1>
    <p>You won the following prize:</p>
    <h2> <?= $model->descr ?>!</h2>
    <?= Html::a('Get it now!', Url::to(['data/view', 'id' => $model->id]), ['class' => 'btn btn-info btn-lg']) ?> 
</div>