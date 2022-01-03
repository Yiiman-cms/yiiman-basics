<?php


namespace YiiMan\YiiBasics\lib;


use yii\helpers\ArrayHelper;

class theme
{
    private static $fonts = [];

    

    /**
     * @param $array
     */
    public static function addFonts($array)
    {
        self::$fonts = $array;
    }

    public static function getFonts()
    {
        $array =
            [
                [
                    'value' => "Arial, Helvetica, sans-serif",
                    'text' => "Arial"
                ],
                [
                    'value' => 'Lucida Sans Unicode", "Lucida Grande", sans-serif',
                    'text' => 'Lucida Grande'
                ],
                [
                    'value' => 'Palatino Linotype", "Book Antiqua", Palatino, serif',
                    'text' => 'Palatino Linotype'
                ],
                [
                    'value' => '"Times New Roman", Times, serif',
                    'text' => 'Times New Roman'
                ],
                [
                    'value' => "Georgia, serif",
                    'text' => "Georgia, serif"
                ],
                [
                    'value' => "Tahoma, Geneva, sans-serif",
                    'text' => "Tahoma"
                ],
                [
                    'value' => 'Comic Sans MS, cursive, sans-serif',
                    'text' => 'Comic Sans'
                ],
                [
                    'value' => 'Verdana, Geneva, sans-serif',
                    'text' => 'Verdana'
                ],
                [
                    'value' => 'Impact, Charcoal, sans-serif',
                    'text' => 'Impact'
                ],
                [
                    'value' => 'Arial Black, Gadget, sans-serif',
                    'text' => 'Arial Black'
                ],
                [
                    'value' => 'Trebuchet MS, Helvetica, sans-serif',
                    'text' => 'Trebuchet'
                ],
                [
                    'value' => 'Courier New", Courier, monospace',
                    'text' => 'Courier New", Courier, monospace'
                ],
                [
                    'value' => 'Brush Script MT, sans-serif',
                    'text' => 'Brush Script'
                ]
            ];
        return ArrayHelper::merge(self::$fonts,$array);
    }
}
