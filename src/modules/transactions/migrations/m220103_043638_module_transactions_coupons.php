<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_043638_module_transactions_coupons extends Migration
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
            '{{%module_transactions_coupons}}',
            [
                'id'=> $this->primaryKey(11),
                'price'=> $this->float(10)->notNull()->comment('قیمت(صفر= نامحدود)'),
                'expire'=> $this->integer(11)->notNull()->comment('زمان انقضا(روز)'),
                'status'=> $this->tinyInteger(1)->notNull()->comment('وضعیت انتشار'),
                'start_from'=> $this->datetime()->notNull()->comment('تاریخ آغاز به کار'),
                'limit_count'=> $this->integer(11)->notNull()->comment('محدودیت تعداد استفاده '),
                'mode'=> $this->tinyInteger(1)->notNull()->comment('نوع استفاده ی کوپن، مثلا قابل استفاده بر روی محصول، یا فاکتور'),
                'uid_limit'=> $this->integer(11)->null()->defaultValue(null)->comment('محدودیت برای کاربر خاص'),
                'created_at'=> $this->datetime()->notNull()->comment('تاریخ ایجاد'),
                'created_by'=> $this->integer(11)->notNull()->comment('کاربر ثبت کننده'),
            ],$tableOptions
        );
        $this->createIndex('uid_limit','{{%module_transactions_coupons}}',['uid_limit'],false);
        $this->createIndex('created_by','{{%module_transactions_coupons}}',['created_by'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('uid_limit', '{{%module_transactions_coupons}}');
        $this->dropIndex('created_by', '{{%module_transactions_coupons}}');
        $this->dropTable('{{%module_transactions_coupons}}');
    }
}
