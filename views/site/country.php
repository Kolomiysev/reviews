<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'Интернет магазины '.$title;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-country">

<h1><?= Html::encode($this->title) ?></h1>

<?php






    $columns=[
        'name',
        'url',
        'rating',
        [
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column) {
                return Html::a('<button class="btn btn-success">Читать отзывы</button>',
                    Url::to([Yii::$app->controller->id . '/reviews', 'url' => $model->url]),
                    ['class' => 'table_button']
                );

            }
        ],
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'tableOptions' => array('class' => 'table table-bordered'),
        'columns' => $columns
    ]);




?>
</div>