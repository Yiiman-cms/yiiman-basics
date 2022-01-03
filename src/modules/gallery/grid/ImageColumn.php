<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace YiiMan\YiiBasics\modules\gallery\grid;

use YiiMan\YiiBasics\lib\Model;


use YiiMan\YiiBasics\modules\filemanager\widget\MediaViewWidget;
use YiiMan\YiiBasics\modules\setting\models\DynamicModel;
use yii\grid\Column;

/**
 * SerialColumn displays a column of row numbers (1-based).
 *
 * To add a SerialColumn to the [[GridView]], add it to the [[GridView::columns|columns]] configuration as follows:
 *
 * ```php
 * 'columns' => [
 *     // ...
 *     [
 *         'class' => 'yii\grid\SerialColumn',
 *         // you may configure additional properties here
 *     ],
 * ]
 * ```
 *
 * For more details and usage information on SerialColumn, see the [guide article on data widgets](guide:output-data-widgets).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ImageColumn extends Column
{
    /**
     * {@inheritdoc}
     */
    public $header = 'تصاویر';

    private static $dmodel;

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if (empty(self::$dmodel)){
            self::$dmodel=new DynamicModel();
            self::$dmodel->defineAttribute('image','');
            self::$dmodel->defineAttribute('id','');
            self::$dmodel->formName=str_replace('Search','',$model->formName());
            self::$dmodel->formName();
            self::$dmodel::$tableName = str_replace('Search','',$model::tableName());
        }
        self::$dmodel->id=$model->id;
        return MediaViewWidget::widget(['attribute' => 'image', 'model' => self::$dmodel, 'count' => 1]);

    }
}
