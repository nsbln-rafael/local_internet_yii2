<?php

use app\models\Post;
use yii\helpers\Html;
use yii\web\View;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var View $this */
/* @var Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот пост?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'image',
                'format'    => ['image', ['width' => '200', 'height' => '200']],
                'value'     => fn($model) => "../uploads/" . $model->image,
            ],
            'title',
            'description_short',
            'description:ntext',
            [
                'attribute' => 'user_id',
                'value'     => fn($model) => $model->user->username
            ],
        ],
    ]) ?>

</div>
