<?php

use yii\db\Schema;
use yii\db\Migration;

class m220103_044046_module_location_neighbourhoodDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%module_location_neighbourhood}}',
                           ["id", "name", "language", "city"],
                            [
    [
        'id' => '1',
        'name' => 'رضاشهر',
        'language' => '1',
        'city' => '1',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%module_location_neighbourhood}} CASCADE');
    }
}
