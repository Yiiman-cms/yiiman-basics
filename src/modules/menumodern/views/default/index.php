<?php

/**
 * @var $this \YiiMan\YiiBasics\lib\View
 */
$assets=\YiiMan\YiiBasics\modules\menumodern\assets\RuleAsset::register($this);
\YiiMan\YiiBasics\widgets\fontAwesomePicker\assets\FontAwesomeFontPickerAssets::register($this);
$this->title = 'تنظیم منوها';
$p = '';
$p .= <<<HTML
<style>
.open {
	display: block;
}
.dropdown-item:focus {
	border: none;
}
.prnt .dropdown-menu a {
	border: none !important;
}
.prnt .dropdown-menu a {
	margin-bottom: 5px;
	margin-top: 5px;
	display: block;
}
.prnt .dropdown-menu {
	height: auto;
}
.nav.flex-column.nav-pills.mega {
    display: flex;
    flex-direction: column;
    width: auto;
    background: hsl(40, 12%, 95.1%);
    height: 100%;
    border-radius: 0 5px 5px 0;
    min-height: 411px;
}
#megatabs .nav-link:hover {
	background: white;
	border-radius: 0px 4px 4px 0px;
	border: none;
	color: hsl(0, 74.4%, 61.8%) !important;
}
#megatabs .mega-dropdown ul a {
	line-height: 12px !important;
	color: hsla(0, 0%, 0%, 0.72) !important;
	font-size: smaller;
}
.mega-dropdown ul a i {
	margin-right: 5px;
	text-decoration: ;
	font-weight: bold;
	color: hsla(0, 0%, 0%, 0.43);
}

.mega-dropdown ul a {
	line-height: 12px !important;
	font-size: smaller;
}
#megatabs .nav-link {
	margin-right: 20px !important;
	padding-bottom: 12px !important;
	padding-top: 12px !important;
	margin-bottom: 0px;
	margin-top: 8px;
	border: none !important;
	color: hsla(0, 0%, 0%, 0.77) !important;
	font-weight: 400;
}
.dropdown-menu.mega-dropdown-menu.shadowTwo.pb0 {
	padding-top: 0 !important;
	width: max-content;
}
.mega-dropdown ul a.parent {
	font-weight: 400;
}
.mega-dropdown .tab-pane {
	padding-right: 0;
}
.mega-dropdown .rb {
	border-right:none !important;
}
#megamenuHeader:hover {
	background: white;
	border-bottom: hsl(0, 94.5%, 49.8%) solid 3px;
}
#megamenuHeader:active {
	background: white;
	border-bottom: hsl(0, 86.5%, 49.2%) solid 2px;
}
#megamenuHeader {
	background: white;
	border-bottom: red solid 2px;
}
.w100p.parent:hover {
	border-bottom-color: white;
	color: hsl(0, 77.1%, 42.7%) !important;
}
#megatabs .nav-link.active {
	background: white;
	border-radius: 0px 4px 4px 0px;
	border: none;
	color: hsl(0, 74.4%, 61.8%) !important;
	box-shadow: none;
}
.dropdown-menu [data-toggle="pill"] i {
	margin-left: 10px;
}
 
.dropdown-menu.child-parent {
	float: left;
	/*display: block;*/
	position: absolute;
	right: 100%;
	/*top: 27%;*/
}
.dropdown-menu > a.dropdown-item:hover{
	color: #fff;
	text-decoration: none;
	background-color: #7297b7;
}

</style>
HTML;

echo $p;
$loadUrl = Yii::$app->Options->BackendUrl . '/menumodern/default/indexx';
$ruleUrl=$assets->baseUrl.'/ruler-combined-solid.svg';
$js = <<<JS
	
	  var ruleUrl='{$ruleUrl}';
	  function lpage(){
		    $.ajax({
			          url: '{$loadUrl}',
			          type: 'get',
			        
			          beforeSend: function (data) {
			          
			          }
			      }).done(function (data) {
			          $('.menu-index').html(data);
			      });
	  }
		$('.menu-index').on('reload',function(){
			lpage();
		});
lpage();
JS;

$this->registerJs($js, $this::POS_END);
$this->registerJs(file_get_contents(__DIR__ . '/../../assets/jquery-ui.min.js'), $this::POS_END);
?>
<div class="menu-index" remove="false" new="false">
</div>
<div class="description-box">
    <p style="margin-top: 20px">
        در این بخش منوها را درست مانند آنچه در سایت لود میشود خواهید دید
    </p>
    <p>
        کلیدهای کنترلی به شما برای ایجاد و ویرایش سریع منوها کمک میکند
    </p>
    <p>
        میتوانید نوار منو را با استفاده از آیکون
            <img height="15" width="15" src="<?= $ruleUrl ?>" alt="">
         به اینطرف و انطرف بکشید(درگ کنید)
    </p>
</div>

