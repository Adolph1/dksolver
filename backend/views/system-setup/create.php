<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SystemSetup */

$this->title = Yii::t('app', 'Create System Setup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'System Setups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="system-setup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
