<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Yii::$app->user->can('updatePost', ['post' => $model]) ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
        <?=
        Yii::$app->user->can('deletePost') ? Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) : ''
        ?>
    </p>

    <div class="blog-post">
        <h2 class="blog-post-title"><?= $model->title?></h2>
        <p class="blog-post-meta"><?= $model->created?> by <a href="#"><?= $model->author->username?></a></p>

        <p><?= $model->descr?></p>
        <hr>
        <p><?= $model->text?></p>
    </div>
    

</div>
