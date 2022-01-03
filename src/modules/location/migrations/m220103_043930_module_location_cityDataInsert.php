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

class m220103_043930_module_location_cityDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%module_location_city}}',
            [
                "id",
                "name",
                "language"
            ],
            [
                [
                    'id'       => '1',
                    'name'     => 'مشهد',
                    'language' => '1',
                ],
                [
                    'id'       => '2',
                    'name'     => 'زنجان',
                    'language' => '1',
                ],
                [
                    'id'       => '3',
                    'name'     => 'بوشهر',
                    'language' => '1',
                ],
                [
                    'id'       => '4',
                    'name'     => 'خوزستان',
                    'language' => '1',
                ],
                [
                    'id'       => '5',
                    'name'     => 'تهران',
                    'language' => '1',
                ],
                [
                    'id'       => '6',
                    'name'     => 'اصفهان',
                    'language' => '1',
                ],
                [
                    'id'       => '7',
                    'name'     => 'کرج',
                    'language' => '1',
                ],
                [
                    'id'       => '8',
                    'name'     => 'شیراز',
                    'language' => '1',
                ],
                [
                    'id'       => '9',
                    'name'     => 'تبریز',
                    'language' => '1',
                ],
                [
                    'id'       => '10',
                    'name'     => 'اهواز',
                    'language' => '1',
                ],
                [
                    'id'       => '11',
                    'name'     => 'قم',
                    'language' => '1',
                ],
                [
                    'id'       => '12',
                    'name'     => 'کرمانشاه',
                    'language' => '1',
                ],
                [
                    'id'       => '13',
                    'name'     => 'ارومیه',
                    'language' => '1',
                ],
                [
                    'id'       => '14',
                    'name'     => 'رشت',
                    'language' => '1',
                ],
                [
                    'id'       => '15',
                    'name'     => 'کرمان',
                    'language' => '1',
                ],
                [
                    'id'       => '16',
                    'name'     => 'بندرعباس',
                    'language' => '1',
                ],
                [
                    'id'       => '17',
                    'name'     => 'همدان',
                    'language' => '1',
                ],
                [
                    'id'       => '18',
                    'name'     => 'زاهدان',
                    'language' => '1',
                ],
                [
                    'id'       => '19',
                    'name'     => 'یزد',
                    'language' => '1',
                ],
                [
                    'id'       => '20',
                    'name'     => 'اردبیل',
                    'language' => '1',
                ],
                [
                    'id'       => '21',
                    'name'     => 'قزوین',
                    'language' => '1',
                ],
                [
                    'id'       => '22',
                    'name'     => 'اراک',
                    'language' => '1',
                ],
                [
                    'id'       => '23',
                    'name'     => 'بابل',
                    'language' => '1',
                ],
                [
                    'id'       => '24',
                    'name'     => 'ساری',
                    'language' => '1',
                ],
                [
                    'id'       => '25',
                    'name'     => 'سنندج',
                    'language' => '1',
                ],
                [
                    'id'       => '26',
                    'name'     => 'گرگان',
                    'language' => '1',
                ],
                [
                    'id'       => '27',
                    'name'     => 'نیشابور',
                    'language' => '1',
                ],
                [
                    'id'       => '28',
                    'name'     => 'آمل',
                    'language' => '1',
                ],
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%module_location_city}} CASCADE');
    }
}
