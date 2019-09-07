<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->can('createPost')?Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']):'' ?>
    </p>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]); ?>


</div>
