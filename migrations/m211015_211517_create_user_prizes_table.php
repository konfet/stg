<?php

use yii\db\Migration;

class m211015_211517_create_user_prizes_table extends Migration
{
   
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('t_user_prizes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'value' => $this->integer(),
            'item_id' => $this->integer(),
            'status' => $this->string()->notNull()->defaultValue('active'),
            'comment' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        
        
        $this->createIndex(
            'idx_user_prizes',
            't_user_prizes',
            ['user_id','status','type']
        );                
    }

    
    
    public function safeDown()
    {
        $this->dropTable('t_user_prizes');
    }
}