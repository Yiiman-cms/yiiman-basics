<?php


namespace YiiMan\YiiBasics\modules\posttypes\widgets;


use yii\bootstrap\Widget;

class Pagination extends Widget
{
    public $posttype = '';

    public function run()
    {
        return $this->html();
    }

    public function html()
    {
        return <<<HTML
                        <div class="pagination fwmpag">
                            <a href="#" class="prevposts-link">
                                <i class="fas fa-caret-right"></i>
                                <span>قبلی</span>
                            </a>
                            <a href="#">1</a>
                            <a href="#" class="current-page">2</a>
                            <a href="#">3</a>
                            <a href="#">...</a>
                            <a href="#">7</a>
                            <a href="#" class="nextposts-link">
                                <span>بعدی</span>
                                <i class="fas fa-caret-left"></i>
                            </a>
                        </div>
HTML;

    }
}
