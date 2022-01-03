<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043128_module_search extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%module_search}}',
            [
                'id'=> $this->primaryKey(11),
                'query'=> $this->string(255)->notNull(),
                'resultCount'=> $this->integer(5)->notNull(),
                'created_at'=> $this->datetime()->notNull(),
                'ip'=> $this->string(15)->notNull(),
                'result_types'=> $this->text()->null()->defaultValue(null),
                'isbot'=> $this->tinyInteger(1)->null()->defaultValue(null),
                'device'=> $this->string(255)->null()->defaultValue(null),
                'lant'=> $this->float(30)->null()->defaultValue(null),
                'lng'=> $this->float(30)->null()->defaultValue(null),
                'country'=> $this->string(100)->null()->defaultValue(null),
                'city'=> $this->string(100)->null()->defaultValue(null),
                'flag'=> $this->string(255)->null()->defaultValue(null),
                'operator'=> $this->string(50)->null()->defaultValue(null),
                'browser'=> $this->string(50)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_search}}');
    }
}
