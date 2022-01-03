<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043529_module_ticket extends Migration
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
            '{{%module_ticket}}',
            [
                'id'=> $this->primaryKey(11),
                'subject'=> $this->string(255)->notNull()->comment('موضوع'),
                'created_at'=> $this->datetime()->notNull()->comment('تاریخ ثبت'),
                'created_by'=> $this->string(255)->notNull()->comment('ثبت شده توسط'),
                'updated_at'=> $this->datetime()->notNull()->comment('آخرین بروزرسانی'),
                'updated_by'=> $this->string(255)->notNull()->comment('بروزرسانی شده توسط'),
                'status'=> $this->tinyInteger(2)->notNull()->comment('وضعیت'),
                'department'=> $this->integer(11)->notNull()->comment('دپارتمان'),
                'deleted_at'=> $this->datetime()->null()->defaultValue(null)->comment('زمان حذف'),
                'deleted_by'=> $this->string(255)->null()->defaultValue(null)->comment('حذف شده توسط'),
                'closed_at'=> $this->datetime()->null()->defaultValue(null)->comment('تاریخ بسته شدن'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'uid'=> $this->integer(11)->null()->defaultValue(null)->comment('کاربر'),
                'serial'=> $this->string(255)->null()->defaultValue(null)->comment('سریال تیکت'),
            ],$tableOptions
        );
        $this->createIndex('uid','{{%module_ticket}}',['uid'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid', '{{%module_ticket}}');
        $this->dropTable('{{%module_ticket}}');
    }
}
