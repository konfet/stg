<?php

/* @var $this yii\web\View */

$this->title = 'Get your prize!';
?>
<div class="site-index">

    <div>
        <div class="promo">
            <?php if(Yii::$app->session->hasFlash('userWasRegistered')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>                
            <!--        <h4><strong>Success!</strong></h4>-->
                    <p>User <?= Yii::$app->session->getFlash('userWasRegistered'); ?> was successfully registered. Check your mail.</p>
                    </div>    
            <?php endif; ?>                                                                                                                      
            
            <?php if(Yii::$app->session->hasFlash('actionDone')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>                
                    <h4><strong>Action was done!</strong></h4>
                    <p><?= Yii::$app->session->getFlash('actionDone'); ?></p>
                    </div>    
            <?php endif; ?>                                                                                                                                  
            
                                                                                                                                         
                                                
            <h1><?= $this->title ?></h1>
            <p>Only today! Every registered user gets a cool gift!</p>
            <p>You can get:</p>
            <ul>
                <li>The money prize!</li>
                <li>Bonus points!</li>
                <li>Cool gifts!</li>                
            </ul>

            <?php if (Yii::$app->user->isGuest):?>
                <p>Register and win!</p>                
                <p><?= \yii\helpers\Html::a('Sign up!', ['site/signup'], ['class' => 'btn btn-success']) ?></p>
                <p><a href="<?= \yii\helpers\Url::to(['user/login']) ?>">Login for existing users</a></p>
                </p>                
            <?php else: ?>
                <p><?= \yii\helpers\Html::a('Get your prize!', ['site/get-random-prize'], ['class' => 'btn btn-success btn-lg']) ?></p>
            <?php
            endif;
            ?>
        </div>        
    </div>
</div>
