<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ing_dish`.
 * Has foreign keys to the tables:
 *
 * - `ingredient`
 * - `dish`
 */
class m171024_074507_create_ing_dish_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ing_dish', [
            'id' => $this->primaryKey(),
            'ingredient_id' => $this->integer(),
            'dish_id' => $this->integer(),
        ]);

        // creates index for column `ingredient_id`
        $this->createIndex(
            'idx-ing_dish-ingredient_id',
            'ing_dish',
            'ingredient_id'
        );

        // add foreign key for table `ingredient`
        $this->addForeignKey(
            'fk-ing_dish-ingredient_id',
            'ing_dish',
            'ingredient_id',
            'ingredient',
            'id',
            'CASCADE'
        );

        // creates index for column `dish_id`
        $this->createIndex(
            'idx-ing_dish-dish_id',
            'ing_dish',
            'dish_id'
        );

        // add foreign key for table `dish`
        $this->addForeignKey(
            'fk-ing_dish-dish_id',
            'ing_dish',
            'dish_id',
            'dish',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `ingredient`
        $this->dropForeignKey(
            'fk-ing_dish-ingredient_id',
            'ing_dish'
        );

        // drops index for column `ingredient_id`
        $this->dropIndex(
            'idx-ing_dish-ingredient_id',
            'ing_dish'
        );

        // drops foreign key for table `dish`
        $this->dropForeignKey(
            'fk-ing_dish-dish_id',
            'ing_dish'
        );

        // drops index for column `dish_id`
        $this->dropIndex(
            'idx-ing_dish-dish_id',
            'ing_dish'
        );

        $this->dropTable('ing_dish');
    }
}
