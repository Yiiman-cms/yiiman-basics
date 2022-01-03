<?php /**
 * Site: https://yiiman.ir
 * AuthorName: gholamreza beheshtian
 * AuthorNumber:09353466620
 * AuthorCompany: YiiMan
 *
 *
 */

use YiiMan\YiiBasics\lib\Triggers;
use yii\base\Event;
use yii\web\Application;
if (empty($options)){
    $options=new \YiiMan\Setting\module\components\Options();
}
$dir = basename(__DIR__);
if (!empty($options->LogEnabled)){
    $components['log'] =
        [
            'traceLevel' => YII_DEBUG ? 1000 : 0,
            'flushInterval' => 3000,   // default is 1000
            'targets' =>
                [
                    [
                        'class' => \YiiMan\YiiBasics\modules\systemlog\models\DbTarget::class,
                        'logTable' => 'module_systemlog',
                        'microtime' => true,
                        'levels' =>$options->LogLevels,
                    ],
                ],
        ];
}

$conf =
    [
        'name' => $dir,
        'type' => ['common'],
        'namespace' => 'YiiMan\YiiBasics\modules\\' . $dir,
        'address' => '',
        'menu' =>

            [
                'name' => $dir,
                'title' => 'لاگ های سیستمی',
                'url' => $dir . '/index']
        ,
    ];



// < اگر تنظیمات اختصاصی برای این ماژول میخواهید این بخش را تنظیم کنید >
{
    $viewAlias = '@system/modules/systemlog/settings';
    $settings =
        [
            [
                'id' => 'LogSettings',
                'tabTitle' => Yii::t('systemlog', 'تنظیمات خطایابی'),
            ]
        ];
}
// </ اگر تنظیمات اختصاصی برای این ماژول میخواهید این بخش را تنظیم کنید >


// < تغییری در این بخش ندهید - این بخش را برای همه ی ماژول هایی که نیاز به تنظیمات دارند کپی کنید >
{
    Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB, function () use ($settings) {
        foreach ($settings as $s) {
            echo '<li>
				<a href="#' . $s['id'] . '" data-toggle="tab">' . $s['tabTitle'] . '</a>
          </li>';
        }

    });
    Event::on(Triggers::className(), Triggers::AFTER_SETTINGS_TAB_CONTENT, function () use ($settings) {
        $model = \YiiMan\YiiBasics\modules\setting\models\DynamicModel::getInstans();
        $form = $model::getForm();
        foreach ($settings as $s) {
            echo '<div class="tab-pane" id="' . $s['id'] . '">';
            (include __DIR__ . '/settings/' . $s['id'] . '.php');
            echo '</div>';
        }
    });
}
// </ تغییری در این بخش ندهید - این بخش را برای همه ی ماژول هایی که نیاز به تنظیمات دارند کپی کنید >




/* < Hooks > */
{
    if (!defined('MTHJK_' . $dir)) {
        /* </ Add translates > */
        {
            Event::on(
                Application::className(),
                Application::EVENT_BEFORE_REQUEST,
                function () use ($conf) {
                    Yii::$app->i18n->translations[$conf['name']] = [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'sourceLanguage' => 'fa-IR',
                        'basePath' => '@system/modules/' . $conf['name'] . '/messages',
                        'fileMap' => [
                            $conf['name'] => 'module.php',
                        ],
                    ];
                }
            );
        }
        /* < Add translates > */
        {
            Event::on(
                Triggers::className(),
                Triggers::EVENT_AFTER_MENU,
                function () use ($conf) {
                    $menu = $conf['menu'];
                    if (empty($menu['items'])) {
                        $title = $conf['menu']['title'];
                        $name = $conf['name'];
                        if (empty($conf['menu']['icon'])) {
                            $icon = 'trip_origin';
                        } else {
                            $icon = $conf['menu']['icon'];
                        }
                        echo <<<EOT
				<li class="nav-item">
                        <a class="nav-link " href="/backend/$name" aria-expanded="false"><i class="material-icons">$icon</i><p>$title</p>
                        </a>
                        </li>
EOT;


                    } else {
                        $title = $conf['menu']['title'];
                        $name = $conf['name'];
                        if (empty($conf['menu']['icon'])) {
                            $icon = 'trip_origin';
                        } else {
                            $icon = $conf['menu']['icon'];
                        }
                        if (!empty($conf['menu']['title'])) {
                            echo <<<EOT

<li class="nav-item">
	<a class="nav-link collapsed" href="#$name" data-toggle="collapse" aria-expanded="false"><i class="material-icons">$icon</i><p>$title<b class="caret"></b></p></a>
	<div class="collapse" id="$name" style="">
		<ul class="nav">
EOT;

                            foreach ($menu['items'] as $item) {
                                $sName = $item['name'];
                                $sTitle = $item['title'];
                                if (empty($item['icon'])) {
                                    $sIcon = 'trip_origin';
                                } else {
                                    $sIcon = $item['icon'];
                                }
                                echo <<<EOT
			<li class="nav-item">
				<a class="nav-link" href="/backend/$name/$sName">
					<i class="material-icons">$sIcon</i>
					<p class="sidebar-normal">$sTitle</p>
				</a>
			</li>
			
EOT;
                            }
                            echo <<<EOT
		
		</ul>
	</div>
</li>
EOT;
                        }


                    }


                }
            );
        }
    }
}
/* </ Hooks > */

if (!defined('MTHJK_' . $dir)) {
    define('MTHJK_' . $dir, '1');
}
return $conf;
