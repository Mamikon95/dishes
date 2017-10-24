<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

?>


<?php Pjax::begin(['id' => 'products_container']); ?>
<div class="panel panel-default">
    <div class="panel-body">
        <p>Ингредиенты:</p>
        <?=Html::checkboxList('ingredients',$ingredients_filter,ArrayHelper::map($ingredients,'id','title'),
            [
                'class' => 'ingredient_class',
                'item'=>function ($index, $label, $name, $checked, $value) use($ingredients_filter){

                    //Параметры фильтра
                    $filter_get = $ingredients_filter;

                    if(in_array($value,$ingredients_filter)) {
                        $filter_get = array_diff($filter_get,[$value]);
                    } else {
                        $filter_get = ArrayHelper::merge([$value],$filter_get);
                    }

                    return Html::a(
                        Html::checkbox($name, $checked, [
                            'value' => $value,
                            'label' => $label,
                        ]),
                        ['/products', 'ingredients_filter' =>  $filter_get]
                    );
                }
            ]
        )?>
    </div>
    <div class="panel-footer">
        <p>Блюда:</p>
        <?if($error_text):?>
            <p><?=$error_text?></p>
        <?elseif(!$dishes):?>
            <p>Ничего не найдено.</p>
        <?else:?>
            <?foreach($dishes as $dish):?>
                <?=$dish->id.' - '.$dish->title?><br>
            <?endforeach;?>
        <?endif;?>
    </div>
</div>
<?php Pjax::end(); ?>