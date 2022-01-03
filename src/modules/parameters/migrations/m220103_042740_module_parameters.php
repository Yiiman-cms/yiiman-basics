<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_042740_module_parameters extends Migration
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
            '{{%module_parameters}}',
            [
                'id'=> $this->primaryKey(11),
                'key'=> $this->string(255)->notNull()->comment('نام کلید'),
                'val'=> $this->string(255)->notNull()->comment('مقدار داخل کلید'),
                'description'=> $this->string(255)->null()->defaultValue(null)->comment('توضیحات کوتاه در مورد این کلید'),
                'language'=> $this->integer(11)->null()->defaultValue(null),
                'language_parent'=> $this->integer(11)->null()->defaultValue(null),
                'protected'=> $this->tinyInteger(1)->null()->defaultValue(null)->comment('آیا توسط سیستم محافظت شده است'),
                'private'=> $this->tinyInteger(1)->null()->defaultValue(null)->comment('مخفی دید از ادیتور ها،(مخصوص مقادیری که فقط در قالب اجرا میشوند)'),
                'editor'=> $this->tinyInteger(1)->null()->defaultValue(null)->comment('آیا از ادیتور برای ویرایش این مقدار استفاده شود؟'),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%module_parameters}}');
    }
}
