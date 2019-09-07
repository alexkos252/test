<?php 
use yii\helpers\Html;
?>
<div class="container">
    <h1 class="jumbotron-heading"><?= Html::a($model->title, ['view', 'id' => $model->id])?></h1>
    <p class="blog-post-meta"><?= $model->created?> by <a href="#"><?= $model->author->username?></a></p>
    <p class="lead text-muted"><?= $model->descr?></p>
    <p>
        <?= Yii::$app->user->can('updatePost',['post' => $model])?Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']):'' ?>
        <?= Yii::$app->user->can('deletePost')?Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this post?',
                'method' => 'post',
            ],
        ]):'' ?>
    </p>
</div>
