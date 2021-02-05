<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var View               $this */
/* @var ActiveDataProvider $dataProvider */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'image',
                'format'    => ['image', ['width' => '100', 'height' => '100']],
                'value'     => fn($model) => "../uploads/" . $model->image,
            ],
            [
                'attribute' => 'title',
                'format'    => 'raw',
                'value' => fn($model) => Html::a($model->title, ['post/view', 'id' => $model->id])
            ],
            [
                'attribute' => 'description_short',
                'format'    => 'raw',
                'value' => fn($model) => Html::a($model->description_short, ['post/view', 'id' => $model->id])
            ],
            [
                'attribute' => 'user_id',
                'value' => fn($model) => $model->user->username
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
