<?php

use app\models\search\PostListSearch;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var View           $this */
/* @var PostListSearch $model */
/* @var ActiveForm     $form */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
