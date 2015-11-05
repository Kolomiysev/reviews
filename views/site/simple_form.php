<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'simple_form','options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'input') ?>

    <?= $form->field($model, 'textarea')->textArea(['rows'=>2,'cols'=>5]) ?>

    <?= $form->field($model, 'select')->dropDownList(['1'=>'first','2'=>'two'],['prompt'=>'-Select-']) ?>

    <?= $form->field($model, 'uploadFile')->fileInput() ?>

    <?= $form->field($model, 'uploadMulti[]')->fileInput(['multiple'=>'multiple']) ?>

    <?= $form->field($model, 'checkbox')->checkbox() ?>

    <?= $form->field($model, 'checkboxList[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']) ?>

    <?= $form->field($model, 'radio')->radio() ?>

    <?= $form->field($model, 'radioList')->radioList(array('1'=>'One',2=>'Two')); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>