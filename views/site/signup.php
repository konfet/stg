<?php
    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    $this->title = 'Registration form';
//    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-lg-6">
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin([
        'id' => 'signup-form',
//        'layout' => 'horizontal',
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
        ]) ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'email') ?>    
<div class="form-group">
    <div>
        <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
</div>
