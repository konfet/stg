<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Your personal data';
?>
<div class="col-lg-6">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
//        ],
    ]); ?>
        
        <?= $form->field($user, 'username')->textInput(['readOnly'=> true,]) ?>
        <?= $form->field($user, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($user, 'bank_account')->textInput() ?>
        <?= $form->field($user, 'bonus_account')->textInput() ?>
        <?= $form->field($user, 'address')->textInput() ?>
           
        <div class="form-group">
            <div class="offset-lg-4 col-lg-7">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?> &nbsp;&nbsp;
                <?= Html::a('Cancel', Yii::$app->homeUrl, ['class' => 'btn btn-warning btn-lg']) ?>                
            </div>             
        </div>

    <?php ActiveForm::end(); ?>
</div>
