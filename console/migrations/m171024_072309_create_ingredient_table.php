<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingredient`.
 */
class m171024_072309_create_ingredient_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ingredient', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->unique()->notNull(),
            'active' => $this->smallInteger(1)->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ingredient');
    }
}
