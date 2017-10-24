<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish`.
 */
class m171024_072625_create_dish_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dish', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dish');
    }
}
