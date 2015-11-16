<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="site-index">

<p style="text-indent: 1.5em;">
    Все мы знаем как сложно найти хороший интернет-магазин. Красивый дизайн, продающий текст, заманчивые цены, вежливые консультанты,
    все это - лишь элементы маркетинга, цель которога состоит в том, чтобы помочь вам расстаться с вашими деньгами.
    Единственный фактор, на который стоит обращать внимание - это отзывы.
    НО не спешите читать отзывы в самом интернет-магазине,т.к. 90% из них написаны самими владельцами магазина либо их сотрудниками.
    Конечно, существуют разные интернет-ресурсы, на которых Вы можете почитать отзывы... но и там, в основном, они так же оставляются специально нанятыми для этих целей людьми.
</p>

<p style="text-indent: 1.5em;">
    Цель нашего проекта - помочь Вам не стать жертвой маркетинга и получить возможность ознакомиться с мнениями реальных покупателей.
    Для одного интернет-магазина можно оставить лишь ОДИН отзыв используя для этого профиль из социальных сетей. Таким образом исключается большая часть манипуляций с накруткой а явно заказные отзывы с левых аккаунтов удаляются.
</p>

    <?php /*

    <?php $form = ActiveForm::begin(['id' => 'search']); ?>
    <div class="form-group">
        <?= $form->field($model, 'search')->label(false) ?>

        <?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    */ ?>

<p>

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

    echo"<h3>ТОП-5 Интернет-магазинов Украины</h3>";

    echo GridView::widget([
        'dataProvider' => $dataProvider_ua,
        'summary' => false,
        'tableOptions' => array('class' => 'table table-bordered'),
        'columns' => $columns
    ]);

    echo Html::a('<button class="btn btn-link">Весь список</button>',
        Url::to([Yii::$app->controller->id . '/country', 'code' => 'ua']),
        ['class' => 'table_button']
    );

    echo"<h3>ТОП-5 Интернет-магазинов России</h3>";

    echo GridView::widget([
        'dataProvider' => $dataProvider_ru,
        'summary' => false,
        'tableOptions' => array('class' => 'table table-bordered'),
        'columns' => $columns
    ]);

    echo Html::a('<button class="btn btn-link">Весь список</button>',
        Url::to([Yii::$app->controller->id . '/country', 'code' => 'ru']),
        ['class' => 'table_button']
    );



    ?>

</p>

</div>