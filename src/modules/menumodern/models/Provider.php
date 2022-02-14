<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\modules\menumodern\models;

use Codeception\PHPUnit\Constraint\Page;
use HTML5;
use YiiMan\YiiBasics\lib\Helper;
use YiiMan\YiiBasics\modules\menumodern\assets\MegaMenuAssets;
use YiiMan\YiiBasics\modules\pages\models\Pages;
use YiiMan\YiiBasics\modules\slug\models\Slug;
use yii;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use YiiMan\YiiBasics\modules\menumodern\models\Menu;
use \yii\db\Query;
use yii\helpers\Url;
use function json_encode;
use function var_dump;

class Provider
{


    public static function getFrontendMegamenuHtml()
    {
        $assets = MegaMenuAssets::register(Yii::$app->view);
        $url = $assets->baseUrl.'/megamenu.css';
        $css = "<link rel='stylesheet' href='".$url."' type='text/css' media='all'>";
        if (!file_exists(__DIR__."/menu.text")) {
            $provider = new self();
            $menu = $provider->getMenu();

            $menuCatch = fopen(__DIR__."/menu.text", "w");
            $html = $provider->getMegaMenu($menu);
            fwrite($menuCatch, $html);
            fclose($menuCatch);
            return $css.$html;
        } else {
            chmod(__DIR__."/menu.text", 0775);
            return $css.file_get_contents(__DIR__."/menu.text");
        }
    }

    public function getMenu()
    {
        return $this->gmenu(
            Menu::find()->where(['enable' => 1])->orderBy(
                'position ASC'
            )->all()
        );
    }

    public function gmenu($model, $parent = null, $maxLevel = 6, $i = 1)
    {
        $items = [];
        foreach ($model as $k => $item) {
            if ($i == 1 && $item->menuType != 'parent') {
                continue;
            }

//				if ($i==2 &&
//				    (
//					    $item->menuType!='right'||
//					    $item->menuType!='childParent'
//				    )
//				){
//					continue;
//				}

//				if ($i==3 &&
//				    (
//
//					    $item->menuType!='child'
//
//				    )
//				){
//					continue;
//				}

//				if ($i==4 &&
//				    (
//					    $item->menuType!='child2'
//				    )
//				){
//					continue;
//				}


            $url = $this->menuUrl($item);
            if (!empty($parent)) {
                if ($parent == $item->parent_id) {
                    $items[$k] =
                        [
                            'label'  => $item->name,
                            'icon'   => $item->icon,
                            'column' => $item->column,
                            'img'    => $item->img,
                            'type'   => $item->menuType,
                            'url'    => $url,
                            'level'  => $i,
                            'parent' => $item->parent_id,
                            'id'     => $item->id,
                        ];
                    if ($i < $maxLevel) {
                        $items[$k]['items'] = $this->gmenu($model, $item->id, $maxLevel, ($i + 1));
                    } else {
                        $items[$k]['items'] = [];
                    }
                }
            } else {
                $items[$k] =
                    [
                        'label'  => $item->name,
                        'icon'   => $item->icon,
                        'column' => $item->column,
                        'img'    => $item->img,
                        'url'    => $url,
                        'type'   => $item->menuType,
                        'level'  => $i,
                        'parent' => $item->parent_id,
                        'id'     => $item->id,
                    ];
                if ($i < $maxLevel) {
                    $items[$k]['items'] = $this->gmenu($model, $item->id, $maxLevel, ($i + 1));
                } else {
                    $items[$k]['items'] = [];
                }
            }
        }

        return array_values($items);
    }

    protected function menuUrl($item)
    {
        if (!empty($item->hyper_url)) {
            return $item->hyper_url;
        }

        if ($item->url > 0 && empty($item->hyper_url)) {
            $slug = Slug::getSlug($item);
            if (!empty($slug)) {
                return Yii::$app->urlManager->createUrl(['/'.$slug]);
            }
            $type = Menu::getType($item->menuContentType);

            $table = $type['model']::tableName();
            $slug = Slug::findOne([
                'table_name' => $table,
                'table_id'   => $item->url
            ]);
            if (!empty($slug)) {
                return Yii::$app->urlManager->createUrl(['/'.$slug->slug]);
            }
            return yii::$app->urlManager->createUrl(['/site/'.$type['action'].'?id='.$item->url]);
        }
    }

    /**
     * @param $items
     *              مگامنوی سایت
     * @return string
     */
    public function getMegaMenu($items, $isadmin = false)
    {
//			$menus=Menu::find()->where(['menuType'=>'right'])->all();
//			foreach ($menus as $menu){

//				$menu->parent_id=566;
//				$menu->save();
//			}


        $baseUrl = Yii::$app->request->baseUrl;
        $menu = '';
        $p = '<ul class="nav navbar-nav">';

        if ($isadmin == true) {

            echo $st = <<<HTML
<style>
.dropdown-menu [data-toggle="pill"] i:hover {
	color: white !important;
}
.dropdown-menu.mega-dropdown-menu.shadowTwo.pb0 {
			padding-top: 0 !important;
			width: calc(100vw - 30vw) !important;
			border-radius: 8px !important;
			top: 60px !important;
		}
		
		
</style>
HTML;

        } else {
            echo $st = <<<HTML
<style>
.dropdown-menu [data-toggle="pill"] i:hover {
	color: hsl(0, 74.4%, 61.8%) !important;
}
.dropdown-menu.mega-dropdown-menu.shadowTwo.pb0 {
	padding-top: 0 !important;
	width: 88vw !important;
	border-radius: 8px !important;
}
</style>
HTML;

        }
        foreach ($items as $key => $level1) {
            if ($isadmin == false && empty($level1['items'][0]['items'])) {
                if (empty($level1['url'])) {
                    continue;
                }
            }


            /* < این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */
            {
                if (empty($items[$key + 1]) && $isadmin) {
                    $ar =
                        [
                            'type' => $level1['type'],
                            'id'   => $level1['id']
                        ];
                    $add = "addparent='".json_encode($ar)."'";
                } else {
                    $add = '';
                }
            }
            if ($isadmin) {
                $url = '#';
            } else {
                $url = $level1['url'];
            }
            /* </ این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */
            $p .= '<li class="dropdown mega-dropdown" data-id="'.$key.'">';

            $dropdown = '';
            if (!empty($level1['items']) || $isadmin) {
                $dropdown = 'data-toggle="dropdown"';
            }

            $p .= '<a href="'.$url.'"   '.$dropdown.' data-id="'.$key.'" label="'.$level1['label'].'" mode="detail" tid="'.$level1['id'].'" '.$add.'  delete edit><i class="fa '.$level1['icon'].'"></i> '.$level1['label'].'</a>';
            /* < right Menu > */
            {
                if (!empty($level1['items']) || $isadmin) {
                    $p .= <<<HTML
<ul class="dropdown-menu mega-dropdown-menu shadowTwo pb0" data-id="$key" >
	<div class="row">
		<div class="col-md-3">
			<div class="nav flex-column nav-pills mega" id="megatabs" role="tablist" aria-orientation="vertical">
HTML;
                    /* < Nav Bars > */
                    {
                        foreach ($level1['items'] as $keyRight => $right) {
                            if ($right['type'] == 'right') {
                                if (isset($right['items']) || $isadmin) {
                                    if ($keyRight == 0) {
                                        /* < این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */
                                        {
                                            if (empty($items[$key + 1]) && $isadmin) {
                                                $ar =
                                                    [
                                                        'type' => $level1['type'],
                                                        'id'   => $level1['id']
                                                    ];
                                                $add = "addparent='".json_encode($ar)."'";
                                            } else {
                                                $add = '';
                                            }
                                        }
                                        /* </ این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */

                                        if (empty($right['items']) && !empty($right['url'])) {
                                            $url = $right['url'];
                                        } else {
                                            $url = '#nav-'.$right['id'];
                                        }
                                        $p .= <<<HTML
      <a class="nav-link  right-m active" id="v-pills-home-tab" data-toggle="pill" href="{$url}" role="tab" aria-controls="v-pills-home" aria-selected="true" tid="{$right['id']}" label="{$right['label']}" mode="detail" {$add} delete edit right><i class="fa {$right['icon']}" ></i>{$right['label']}</a>
HTML;
                                    } else {
                                        /* < این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */
                                        {
                                            if (empty($items[$key + 1]) && $isadmin) {
                                                $ar =
                                                    [
                                                        'type' => $level1['type'],
                                                        'id'   => $level1['id']
                                                    ];
                                                $add = "addparent='".json_encode($ar)."'";
                                            } else {
                                                $add = '';
                                            }
                                        }
                                        /* </ این بخش برای بک اند تولید میشود، پس از این پارامتر کلید + قرار داده میشود > */
                                        if (empty($right['items']) && !empty($right['url'])) {
                                            $url = $right['url'];
                                        } else {
                                            $url = '#nav-'.$right['id'];
                                        }


                                        $p .= <<<HTML
      <a class="nav-link right-m" id="v-pills-home-tab" data-toggle="pill" href="{$url}" role="tab" aria-controls="v-pills-home" aria-selected="false" tid="{$right['id']}" label="{$right['label']}" mode="detail" {$add} delete edit right>
      <i class="fa {$right['icon']}" ></i>{$right['label']}</a>
HTML;
                                    }
                                }
                            }
                        }
                    }
                    /* </ Nav Bars > */
                    $p .= <<<HTML
			</div>
		</div>
HTML;
                }
            }
            /* </ right Menu > */


            /* < Nav Contents > */
            {
                if (!empty($level1['items']) || $isadmin) {
                    $p .= "<div class='col-md-9'>";
                    $p .= '<div class="tab-content" id="nav-tabContent">';
                    foreach ($level1['items'] as $keyRight => $right) {
                        //					$count     = count( $item['items'] );
                        if (empty($right['items'])) {
                            continue;
                        }
                        $colNumber = $right['column'] ? $right['column'] : 3;
                        $col = 12 / 4;

                        /* < Open First panel > */
                        {
                            if ($keyRight == 0) {
                                $p .= '<div class="tab-pane fade active" id="nav-'.$right['id'].'" role="tabpanel">';
                            } else {
                                $p .= '<div class="tab-pane fade" id="nav-'.$right['id'].'" role="tabpanel">';
                            }
                        }
                        /* </ Open First panel > */


                        $p .= '<div class="row">';
                        if ($right['img']) {
                            $p .= '     <div class="col-md-12">';
                        } else {
                            $p .= '     <div class="col-md-12">';
                        }

                        $colPart = array_chunk($right['items'], ceil(count($right['items']) / 4));

                        foreach ($colPart as $part) {

                            $p .= '<li class="col-sm-'.$col.' rb p10">';
                            $p .= '     <ul class="p0 w100p">';
                            foreach ($part as $leftItem) {
                                $p .= '         <li tid="'.$leftItem['id'].'">';
                                $p .= '<a class="w100p parent"  href="'.$leftItem['url'].'" mode="detail" label="'.$leftItem['label'].'" tid="'.$leftItem['id'].'" edit delete lev2>'.$leftItem['label'].'<i class="fa fa-angle-left" aria-hidden="true" ></i></a>';


                                /* < underMenu > */
                                {
                                    if (!empty($leftItem['items'])) {
                                        foreach ($leftItem['items'] as $level3) {
                                            $p .= '         <li tid="'.$level3['id'].'">';
                                            $p .= '<a class="w100p "  href="'.$level3['url'].'" mode="detail" label="'.$level3['label'].'" tid="'.$level3['id'].'" edit delete lev2>'.$level3['label'].'</a>';
                                            $p .= '         </li>';
                                        }
                                    }
                                }
                                /* </ underMenu > */

                                $p .= '         </li>';
                            }
                            $p .= '     </ul>';
                            $p .= '</li>';
                        }

                        $p .= '        </div>';

//					if ( $item['img'] ) {
//						$p .= '     <div class="col-md-3 rb">';
//						$p .= '     <img src="' . $baseUrl . $item['img'] . '" width="100%">';
//						$p .= '     </div>';
//					}

                        $p .= '    </div>';
                        $p .= ' </div>';
                    }
                    $p .= '</div>';
                    $p .= '</div>';
                }
            }
            /* </ Nav Contents > */
            if (!empty($level1['items']) || $isadmin) {
                $p .= '</div>';

                $p .= '</ul>';
            }

            $p .= '</li>';
        }

        $p .= '</ul>';

        return $p;
    }

    public function topMenu()
    {
        if (Yii::$app->user->isGuest) {
            $items[] = [
                'label' => Yii::t('app', 'Login').'/'.Yii::t('app', 'Register'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'Login'),
                        'url'   => Url::to(['site/login'])
                    ],
                    [
                        'label' => Yii::t('app', 'Register'),
                        'url'   => Url::to(['site/signup'])
                    ],
                    [
                        'label' => Yii::t('app', 'Favourite list'),
                        'url'   => Url::to(['site/favourite'])
                    ]
                ]
            ];
        } else {
            $items[] = [
                'label' => Yii::$app->user->identity->nickName ? Yii::$app->user->identity->nickName : Yii::$app->user->identity->email,
                'items' => [
                    [
                        'label' => Yii::t('app', 'Profile'),
                        'url'   => Url::to(['site/profile'])
                    ],
                    [
                        'label' => Yii::t('app', 'My orders'),
                        'url'   => Url::to(['site/my-orders'])
                    ],
                    [
                        'label' => Yii::t('app', 'Favourite list'),
                        'url'   => Url::to(['site/favourite'])
                    ],
                    [
                        'label'       => Yii::t('app', 'Logout'),
                        'url'         => Url::to(['site/logout']),
                        'linkOptions' => ['data-method' => 'POST']
                    ]
                ]
            ];
        }

        return $items;
    }

    public function languageMenu()
    {

        $items[] = [
            'label' => Yii::t('app', 'Farsi'),
            'items' => [
                [
                    'label' => Yii::t('app', 'Farsi'),
                    'url'   => Url::to([''])
                ],
                [
                    'label' => Yii::t('app', 'English'),
                    'url'   => Url::to([''])
                ]
            ]
        ];

        return $items;
    }
}



