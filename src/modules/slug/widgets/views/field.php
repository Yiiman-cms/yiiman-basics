<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @var $this         \YiiMan\YiiBasics\lib\View
 * @var $id           integer
 * @var $value        string
 * @var $name         string
 * @var $origModel    \YiiMan\YiiBasics\lib\ActiveRecord
 * @var $options      []
 */
$id = !empty($origModel->id) ? $origModel->id : '0';
$bu = Yii::$app->urlManager->createUrl(['/slug/default/check']);
$js = <<<JS
	var slugok=true;
    var isokInJs=true;
$('#$id').on('focusout',function(e) {
    isokInJs=true;
    let value=$(this).val();
    if (value.length===0){
        $('#{$id}hinthelp').empty();
         $('[type="submit"]').prop( "disabled", false );
		            slugok = true;
    }
	var data={slug:value,id:{$id}};
	let str=value;
	let arr=str.split("");
	
	$.each(arr,function(index,char) {
	 
		if ($.inArray( char, [ ' ' , '-' , '.' , '/' , '&' , '$' , '%' , '^' , '!' , "#" , "~", "`",'<','>','|','{','}','[',']','?',':','"','*','=','@','(',')' ])>-1){
		     console.log('error');
			$('#{$id}hinthelp').html('<span style="color: red">نمیتوانید از این کاراکتر ها استفاده کنید:    -   .   /   \   &   $   %   ^   !   #   ~   `   (   )   =   +   *   @   ; , " \' <> _  | [] {} ? : </span>');
			isokInJs=false;
			return false;
		}else{
			isokInJs=true;
		}
	});
	
	if (isokInJs){
		$.ajax({
		        url: '$bu',
		        type: 'post',
		        data: data,
		        beforeSend: function (data) {
		        
		        }
		    }).done(function (data) {
		        
		        $('#{$id}hinthelp').html(data.message);
		        if (data.status=='success') {
		            $('[type="submit"]').prop( "disabled", false );
		            slugok = true;
		        }else{
		            $('[type="submit"]').prop( "disabled", true );
		            slugok = false;
		        }
		    });
	}
	
	
});
$('button').click(function(e) {
  if (!slugok){
      e.preventDefault();
  }
})
JS;
$this->registerJs($js, $this::POS_END);
?>
<style>
    #w1hinthelp {
        margin-top: 11px;
        display: block;
    }
</style>
<input type="text" name="<?= $name ?>" class="form-control" value="<?= $value ?>" id="<?= $id ?>">
<span id="<?= $id ?>hinthelp">
<a class="slug-link" href="<?= Yii::$app->Options->URL.'/'.$value ?>"
   target="_blank"><?= Yii::$app->Options->URL.'/'.$value ?></a>
</span>
