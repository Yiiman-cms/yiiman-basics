<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

use yii\db\Schema;
use yii\db\Migration;

class m220103_043419_module_systemlog extends Migration
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
            '{{%module_systemlog}}',
            [
                'id'              => $this->primaryKey(11),
                'level'           => $this->integer(11)->null()->defaultValue(null)->comment('سطح'),
                'category'        => $this->string(255)->null()->defaultValue(null)->comment('دسته'),
                'log_time'        => $this->datetime()->null()->defaultValue(null)->comment('زمان ثبت'),
                'prefix'          => $this->text()->null()->defaultValue(null)->comment('پیشوند'),
                'message'         => $this->text()->null()->defaultValue(null)->comment('پیام'),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'ip'              => $this->string(30)->null()->defaultValue(null)->comment('آی پی'),
                'uid'             => $this->integer(11)->null()->defaultValue(null)->comment('کاربر'),
                'session_id'      => $this->string(255)->null()->defaultValue(null)->comment('شناسه ی نشست'),
                'app_name'        => $this->string(50)->null()->defaultValue(null)->comment('نام برنامه'),
                'session_details' => $this->string(2000)->null()->defaultValue(null)->comment('اطلاعات سشن'),
                'last_error'      => $this->text()->null()->defaultValue(null)->comment('آخرین خطای رخ داده'),
            ], $tableOptions
        );
        $this->createIndex('idx_log_level', '{{%module_systemlog}}', ['level'], false);
        $this->createIndex('idx_log_category', '{{%module_systemlog}}', ['category'], false);
        $this->createIndex('uid', '{{%module_systemlog}}', ['uid'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('idx_log_level', '{{%module_systemlog}}');
        $this->dropIndex('idx_log_category', '{{%module_systemlog}}');
        $this->dropIndex('uid', '{{%module_systemlog}}');
        $this->dropTable('{{%module_systemlog}}');
    }
}
