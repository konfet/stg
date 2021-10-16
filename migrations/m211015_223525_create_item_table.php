<?php

use yii\db\Migration;

class m211015_223525_create_item_table extends Migration
{
   
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('t_item', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);
        
        $this->insert('t_item', [
            'name' => 'Fleshka',
        ]);
        $this->insert('t_item', [
            'name' => 'Vodka',
        ]);
        $this->insert('t_item', [
            'name' => 'Seledka',
        ]);
        $this->insert('t_item', [
            'name' => 'Kniga o PHP',
        ]);        
    }

    public function safeDown()
    {
        $this->dropTable('t_item');
    }
}
