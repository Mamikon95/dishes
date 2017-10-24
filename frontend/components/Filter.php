<?php

namespace app\components;

use common\models\Dish;
use Yii;
use common\models\IngDish;

/**
 * Класс для работы с блюдами
 * Filter Class
 */
class Filter
{
    /*
     * Фильтряция блюд по ингредиентам
     * @param array $ingredients - массив ингредиентов
     * @return object
     * */
    public function filtering($ingredients) {

        $query = IngDish::find()
            ->select('ing_dish.dish_id,count(ingredient.id) as count_math')
            ->leftJoin('ingredient', 'ingredient.id=ing_dish.ingredient_id')
            ->andWhere(['in', 'ingredient.id', $ingredients])
            ->groupBy('ing_dish.dish_id')
            ->having('count(ingredient_id) >= 2')
            ->orderBy('count_math DESC')
            ->asArray()
            ->all();

        //Блюда с полным совпадением
        $full_dish = [];

        //Все блюда
        $dishes = [];

        foreach($query as $result) {
            if($result['count_math'] == count($ingredients)) {
                $full_dish[] = $result['dish_id'];
            }

            $dishes[] = $result['dish_id'];
        }

        //Если есть блюда с полным совпадением то передаем их
        if(count($full_dish)) {
            $dishes = $full_dish;
        }


        $dishes_obj = [];

        //Объекты блюд(для сортировки такой образ)
        foreach($dishes as $dish) {
            $dishes_obj[] = Dish::findOne($dish);
        }

        return $dishes_obj;
    }
}