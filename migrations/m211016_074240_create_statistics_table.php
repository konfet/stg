<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistics}}`.
 */
class m211016_074240_create_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = 't_statistics';
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'money_received' => $this->integer()->notNull()->defaultValue(0),
            'money_transferred' => $this->integer()->notNull()->defaultValue(0),
            'money_converted_to_bonuses' => $this->integer()->notNull()->defaultValue(0),
            'bonuses_received' => $this->integer()->notNull()->defaultValue(0),
            'bonuses_converted_from_money' => $this->integer()->notNull()->defaultValue(0),
            'bonuses_transferred' => $this->integer()->notNull()->defaultValue(0),
            'items_received' => $this->string(5000)->defaultValue(''),
            'items_sent' => $this->string(5000)->defaultValue(''),
            
        ]);
        
        $this->addForeignKey(
            'fk_user_stat_1',
            $this->tableName,
            'user_id',
            't_user',
            'id',
            'CASCADE'
        );                
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}