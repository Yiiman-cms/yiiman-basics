<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042604_module_notification_messages extends Migration
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
            '{{%module_notification_messages}}',
            [
                'id'=> $this->primaryKey(11),
                'uid'=> $this->integer(11)->notNull()->comment('دریافت کننده'),
                'message'=> $this->string(1000)->notNull()->comment('متن پیام'),
                'target_module'=> $this->string(300)->notNull()->comment('کلاس ماژول مربوط به مسیج'),
                'module_id'=> $this->integer(11)->null()->defaultValue(null)->comment('آي دی کلاس ماژول مربوطه'),
                'notif_channel'=> $this->string(300)->notNull()->comment('کانال مسیج(روش ارسال)'),
                'created_at'=> $this->datetime()->notNull()->comment('تاریخ ثبت'),
                'created_by'=> $this->integer(11)->notNull()->comment('فرستنده'),
                'details_json'=> $this->text()->notNull()->comment('اطلاعات مسیج برای کلاس کانال'),
                'status'=> $this->tinyInteger(1)->notNull()->comment('وضعیت ارسال'),
                'sent_at'=> $this->datetime()->null()->defaultValue(null)->comment('تاریخ ارسال'),
                'send_error'=> $this->string(700)->null()->defaultValue(null)->comment('خطای بوجود امده حین ارسال'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('uid','{{%module_notification_messages}}',['uid'],false);
        $this->createIndex('created_by','{{%module_notification_messages}}',['created_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid', '{{%module_notification_messages}}');
        $this->dropIndex('created_by', '{{%module_notification_messages}}');
        $this->dropTable('{{%module_notification_messages}}');
    }
}
