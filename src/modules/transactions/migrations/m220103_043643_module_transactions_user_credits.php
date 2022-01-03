<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043643_module_transactions_user_credits extends Migration
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
            '{{%module_transactions_user_credits}}',
            [
                'id'=> $this->primaryKey(11),
                'credit'=> $this->float(10)->notNull()->comment('مبلغ کردیت(تومان)'),
                'uid'=> $this->integer(11)->notNull()->comment('کاربری که کردیت را دریافت میکند'),
                'created_at'=> $this->datetime()->notNull()->comment('تاریخ ایجاد'),
                'created_by'=> $this->integer(11)->notNull()->comment('شناسه ی کاربری که کردیت را ایجاد کرده است'),
                'created_user_mode'=> $this->tinyInteger(1)->notNull()->comment('نوع کاربری که ایجاد کردیت کرده است'),
                'description'=> $this->string(255)->null()->defaultValue(null)->comment('توضیحات'),
                'factor'=> $this->integer(11)->notNull()->comment('فاکتور'),
                'status'=> $this->tinyInteger(1)->notNull(),
            ],$tableOptions
        );
        $this->createIndex('factor','{{%module_transactions_user_credits}}',['factor'],false);
        $this->createIndex('uid','{{%module_transactions_user_credits}}',['uid'],false);
        $this->createIndex('created_by','{{%module_transactions_user_credits}}',['created_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('factor', '{{%module_transactions_user_credits}}');
        $this->dropIndex('uid', '{{%module_transactions_user_credits}}');
        $this->dropIndex('created_by', '{{%module_transactions_user_credits}}');
        $this->dropTable('{{%module_transactions_user_credits}}');
    }
}
