<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dish".
 *
 * @property integer $id
 * @property string $title
 *
 * @property IngDish[] $ingDishes
 */
class Dish extends \yii\db\ActiveRecord
{

    public $ingredients = [];

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        //Если есть ингредиенты то удаляем
        if($this->ingDishes) {
            IngDish::deleteAll(['dish_id' => $this->id]);
        }

        //При сохранении ставим ингредиенты для блюда
        foreach ($this->ingredients as $value) {
            $ingd = new ingDish();

            $ingd->ingredient_id = $value;

            $ingd->dish_id = $this->id;

            $ingd->save();
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','ingredients'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'ingredients' => 'Ингредиенты',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngDishes()
    {
        return $this->hasMany(IngDish::className(), ['dish_id' => 'id']);
    }
}
