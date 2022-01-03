<?php


namespace YiiMan\YiiBasics\modules\widget\widgets;


use yii\bootstrap\Widget;

class MapGenerator extends Widget
{
    public $image='';
    public function run()
    {
        MapGeneratorAssets::register($this->view);

        $js=<<<JS
$.each($("img[usemap]"),function(){
    $(this).mapify({
  popOver: {
    content: function(zone){
        var desc='<p style="color:red">'+'غیر قابل ویرایش'+'</p>';
        var ee=false;
        
        if (zone.attr('data-desc')){
            desc ='<p style="color:green">'+zone.attr('data-desc')+'</p>';
            ee=true;
        }
        if (zone.attr('status')){
            if (ee===true){
            desc +='<p style="color:green">داخل این بخش اطلاعات ثبت شده است</p>';
            }
        }else{
            if (ee===true){
            desc +='<p style="color:red">'+'هنوز داخل این بخش اطلاعاتی ثبت نشده'+'</p>';
               
            }
        }
        
      return "<strong>"+zone.attr("data-title")+"</strong> "+desc;
    },
    delay: 0.7,
    margin: "15px",
    height: "130px",
    width: "260px"
  }
});
})

JS;
        $this->view->registerJs($js,$this->view::POS_END);
        return '';
    }
}
