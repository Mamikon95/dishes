<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property integer $id
 * @property string $title
 * @property integer $active
 *
 * @property IngDish[] $ingDishes
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['active'], 'integer'],
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
            'active' => 'Активно',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngDishes()
    {
        return $this->hasMany(IngDish::className(), ['ingredient_id' => 'id']);
    }

    /*
     * Получаем прозвище активности
     * @return string
     * */
    public function getActiveName() {
        return yii::$app->params['activeNames'][$this->active];
    }
}
