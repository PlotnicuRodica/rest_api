<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PoetryCategory */

$this->title = 'Create Poetry Category';
$this->params['breadcrumbs'][] = ['label' => 'Poetry Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poetry-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
