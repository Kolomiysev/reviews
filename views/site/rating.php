<?php

/* @var $this yii\web\View */

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;


$this->title = 'My Yii Application';
?>



<div class="site-index">

    <?php

    Pjax::begin();

    $columns=[
        'name',
        'url',
        'rating'
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'tableOptions' => array('class' => 'table table-bordered'),
        'columns' => $columns
    ]);

    Pjax::end();

    ?>



</div>