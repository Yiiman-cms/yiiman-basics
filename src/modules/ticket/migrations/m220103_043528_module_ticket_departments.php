<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043528_module_ticket_departments extends Migration
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
            '{{%module_ticket_departments}}',
            [
                'id'=> $this->primaryKey(11),
                'title'=> $this->string(255)->notNull()->comment('نام دپارتمان'),
                'status'=> $this->tinyInteger(1)->notNull()->comment('وضعیت انتشار'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_ticket_departments}}');
    }
}
