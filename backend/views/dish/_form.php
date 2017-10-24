<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */
/* @var $form yii\widgets\ActiveForm */

$ingredients_arr = ArrayHelper::map(\common\models\Ingredient::find()->all(), 'id','title');

?>

<div class="dish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredients')->widget(Select2::classname(), [
        'data' => $ingredients_arr,
        'language' => 'ru',
        'options' => ['multiple' => true, 'placeholder' => 'Выберите ингредиенты ...', 'value' => $model->getIngDishes()->select('ingredient_id')->column()],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
