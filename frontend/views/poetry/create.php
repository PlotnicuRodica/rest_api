<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Poetry */

$this->title = 'Create Poetry';
$this->params['breadcrumbs'][] = ['label' => 'Poetries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poetry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
