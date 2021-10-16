<?php

use yii\db\Migration;

class m211015_233510_create_foreign_keys extends Migration
{
   
    public function safeUp()
    {
         $this->addForeignKey(
            'fk_user_prizes_1',
            't_user_prizes',
            'user_id',
            't_user',
            'id',
            'CASCADE'
        );        
        
        $this->addForeignKey(
            'fk_user_prizes_2',
            't_user_prizes',
            'item_id',
            't_item',
            'id',
            'CASCADE'
        );        
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_user_prizes_1',
            't_user_prizes'
        );
        $this->dropForeignKey(
            'fk_user_prizes_2',
            't_user_prizes'
        );
    }
}
