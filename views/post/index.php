<?php

use app\models\search\PostSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var View               $this */
/* @var PostSearch         $searchModel */
/* @var ActiveDataProvider $dataProvider */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
