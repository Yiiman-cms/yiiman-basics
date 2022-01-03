<?php
/**
 * Copyright (c) 2018-2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */
/**
 * @var $this  \yii\web\View
 * @var $class \YiiMan\YiiBasics\widgets\fileUpload\MaterialFontWidget
 */
$attr = $class->attribute.'-input';
$attr2 = $class->attribute.'-input2';
$url = $class->UploadUrl;
$filename = $class->className.'['.$class->attribute.']'.(!empty($class->multiple) ? '[]' : '');

/* < Build File Type Check > */
{
    if ($class->fileTypes != '.*') {
        $types = str_replace('.', '', $class->fileTypes);
        $types = explode(',', $types);
        $typeText = '';
        foreach ($types as $type) {
            $typeText .= ' case "'.$type.'":
		    ';
        }
    } else {
        $typeText = ' case default:';
    }

}
/* </ Build File Type Check > */
$uploadFunction = 'function upload'.$class->attribute;
$uploadFunctionName = 'upload'.$class->attribute;
if (!empty($class->callBack)) {
    $callBack = $class->callBack.'(response);';
} else {
    $callBack = '';
}
$js = <<<JS
    $(document).ready(function(){
         
            $('#$attr').change(function(e){
                
               
                // check file types
                 var ext = this.value.match(/\.([^\.]+)$/)[1];
                 if (!ext){
                     ext='*';
                 }
                  
                switch(ext)
                {
                    //case "doc": case "docx": case "pdf":
                    $typeText
                    //will call upload function
                    $uploadFunctionName(e);
                        break;
                   
                }
                
                
            
                   $uploadFunction(e){
                        var fileName = e.target.files[0].name;
                
                            if(fileName.length>0){
                                $('#$attr2').val(fileName);
                                var file_data = $('#$attr').prop('files')[0];   
                                var form_data = new FormData();                  
                                form_data.append('$filename', file_data);
                                $.ajax({
                                    url: '$url', // point to server-side PHP script 
                                    dataType: 'text',  // what to expect back from the PHP script, if anything
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,                         
                                    type: 'post',
                                    success: function(response){
                                       $callBack
                                    }
                                 });
                               return true;
                            }else{
                                return false;
                                $('#$attr2').val('');
                            }
                     }  
            
           

           
    
            
        });
        
        
        
    });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
<div class="form-group form-file-upload form-file-multiple">
    <input type="file" multiple="" class="inputFileHidden" id="<?= $attr ?>"
           name="<?= $filename ?>"
           value="<?= $class->model->{$class->attribute} ?>"
           accept="<?= $class->fileTypes ?>"
    >
    <div class="input-group">
        <input type="text" class="form-control inputFileVisible" id="<?= $attr ?>2"
               placeholder="<?= $class->placeholder ?>">
        <span class="input-group-btn" id="<?= $attr ?>-append">
            <button type="button" class="btn btn-fab btn-round btn-primary">
                <i class="material-icons"><?= $class->icon ?></i>
            </button>
        </span>
    </div>
</div>
