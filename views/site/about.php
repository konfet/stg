<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <h2>Текст задания</h2>
    <p>
Нужно разработать веб-приложение для розыгрыша призов. После аутентификации пользователь может
нажать на кнопку и получить случайный приз. Призы бывают 3х типов: денежный (случайная сумма в
интервале), бонусные баллы (случайная сумма в интервале), физический предмет (случайный предмет из
списка).
Денежный приз может быть перечислен на счет пользователя в банке (HTTP запрос к API банка), баллы
зачислены на счет лояльности в приложении, предмет отправлен по почте (вручную работником).
Денежный приз может конвертироваться в баллы лояльности с учетом коэффициента. От приза можно
отказаться. Деньги и предметы ограничены, баллы лояльности нет.</p>
    <p>
В данном задании оценивается не внешний вид приложения, а сам код, в связи с чем необходимо
ориентироваться на code review, а не визуальную и функциональную оценку приложения.</p>
    <p>
Реализация с помощью Yii2 фреймворка, с использованием БД.
Нужно добавить консольную команду которая будет отправлять денежные призы на счета пользователей,
которые еще не были отправлены пачками по N штук.
Добавить юнит-тест конвертирования денежного приза в баллы лояльности
    </p>

<!--    <code><?= __FILE__ ?></code>-->
</div>
