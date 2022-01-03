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

class m220103_043530_module_ticket_messages extends Migration
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
            '{{%module_ticket_messages}}',
            [
                'id'              => $this->primaryKey(11),
                'ticket'          => $this->integer(11)->notNull()->comment('تیکت'),
                'message'         => $this->text()->notNull()->comment('متن پاسخ'),
                'created_at'      => $this->datetime()->notNull()->comment('تاریخ ثبت'),
                'created_by'      => $this->string(255)->notNull()->comment('ثبت شده توسط'),
                'file'            => $this->string(400)->null()->defaultValue(null)->comment('فایل پیوست'),
                'language'        => $this->integer(11)->null()->defaultValue(null),
                'language_parent' => $this->integer(11)->null()->defaultValue(null),
                'uid'             => $this->integer(11)->null()->defaultValue(null)->comment('کاربر'),
                'uid_admin'       => $this->integer(11)->null()->defaultValue(null)->comment('کاربر ادمین'),
            ], $tableOptions
        );
        $this->createIndex('ticket', '{{%module_ticket_messages}}', ['ticket'], false);
        $this->createIndex('uid_admin', '{{%module_ticket_messages}}', ['uid_admin'], false);
        $this->createIndex('uid', '{{%module_ticket_messages}}', ['uid'], false);

    }

    public function safeDown()
    {
        $this->dropIndex('ticket', '{{%module_ticket_messages}}');
        $this->dropIndex('uid_admin', '{{%module_ticket_messages}}');
        $this->dropIndex('uid', '{{%module_ticket_messages}}');
        $this->dropTable('{{%module_ticket_messages}}');
    }
}
