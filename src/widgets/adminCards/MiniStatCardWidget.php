<?php


namespace YiiMan\YiiBasics\widgets\adminCards;


use yii\bootstrap\Widget;

class MiniStatCardWidget extends Widget
{
    public $icon = 'dashboard', $title, $subtitle = '', $unit = '', $footerIcon = 'warning', $link = '#', $color = 'info';

    public function run()
    {
        $html = <<<HTML
<div class="card card-stats">
                <div class="card-header card-header-{color} card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">{icon}</i>
                  </div>
                  <p class="card-category">{title}</p>
                  <h3 class="card-title">{subtitle}
                    <small>{unit}</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons text-danger">{footerIcon}</i>
                    <a href="{link}">بیشتر...</a>
                  </div>
                </div>
              </div>
HTML;
        return str_replace(
            [
                '{color}', '{icon}', '{title}', '{subtitle}', '{unit}', '{footerIcon}', '{link}'
            ],
            [$this->color, $this->icon, $this->title, $this->subtitle, $this->unit, $this->footerIcon, $this->link],
            $html
        );


    }
}
