<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ingredient;

/**
 * Products controller
 */
class ProductsController extends Controller
{

    /**
     * Displays product page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $ingredients = Ingredient::find()->where(['=','active','1'])->all();

        //Получаем выбранные ингредиенты
        $ingredients_filter = yii::$app->request->get('ingredients_filter');

        $ingredients_filter = $ingredients_filter ? $ingredients_filter : [];

        $error_text = '';

        //Если выбрано менее 2 ингредиентов то передать сообщение
        if(count($ingredients_filter) < 2) {
            $error_text = 'Выберите больше ингредиентов';
        } else if(count($ingredients_filter) > 5) {
            $error_text = 'Нельзя выбрать больше 5 ингредиентов';
        }

        //Начальное значение пустое для блюд
        $dishes = [];

        //Если ошибок нет то...
        if(!$error_text) {
            //Фильтруем блюда по ингредиентам
            $dishes = $this->filter($ingredients_filter);
        }

        return $this->render('index',[
            'ingredients' => $ingredients,
            'ingredients_filter' => $ingredients_filter,
            'dishes' => $dishes,
            'error_text' => $error_text
        ]);
    }

    /*
     * Фильтрация блюд по ингредиентам
     * @param array $ingredients - Получаем ингредиенты выбранные пользователем
     * @return object
     * */
    private function filter($ingredients) {

        //Если ингредиентов нет или меньше 2 то
        if(count($ingredients) < 2) {
            return false;
        }

        //фильтруем по ингредиентам
        $dishes = yii::$app->Filter->filtering($ingredients);

        return $dishes;

    }

}
