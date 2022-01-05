<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

namespace YiiMan\YiiBasics\widgets\CodeMirrorSimple;


use kartik\base\InputWidget;
use YiiMan\YiiBasics\lib\View;
use yii\helpers\Html;

class CodeMirrorSimpleWidget extends InputWidget
{
    const MODE_HTML_MIXED = 'htmlmixed/htmlmixed.js';
    const MODE_HTML_EMBEDDED = 'htmlembedded/htmlembedded.js';
    const MODE_JAVASCRIPT = 'javascript/javascript.js';
    const MODE_MARKDOWN = 'markdown/markdown.js';
    const MODE_PHP = 'php/php.js';
    const MODE_CSS = 'css/css.js';
    public $modes = ['htmlmixed/htmlmixed.js'];

    public function run()
    {
        $out='';
        $js = <<<JS

var editorMirror;

    
      var nonEmpty = false;
          
       CodeMirror.commands.autocomplete = function(cm) {
            cm.showHint({hint: CodeMirror.hint.anyword});
       }
      
   
   
   
   
   
     editorMirror = CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
      mode: "application/xml",
      styleActiveLine: true,
      lineNumbers: true,
      // lineWrapping: true,
      theme:'isotope',
      autoCloseBrackets: true,
      autoCloseTags: true,
      foldGutter: true,
      // viewportMargin: Infinity,
      // lint: true,
      gutters: ["CodeMirror-linenumbers"],
      profile: ['css','javascript'],
      extraKeys: 
      {
          "Ctrl-Space": "autocomplete",
          "Ctrl-Q": function(cm) { cm.wrapParagraph(cm.getCursor(), options); },
          "Alt-F": "findPersistent"
          }
    });
   
       
       var totalLines = editorMirror.lineCount();  
       editorMirror.autoFormatRange({line:0, ch:0}, {line:totalLines});
       
       
   // < Mark Number >
   {
       // editorMirror.on("gutterClick", function(cm, n) {
       //    var info = cm.lineInfo(n);
       //    cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
       // });
       
        // function makeMarker() {
        //     var marker = document.createElement("div");
        //     marker.style.color = "#822";
        //     marker.innerHTML = "●";
        //     return marker;
        // }
   }
   // </ Mark Number >
   
   

        function toggleSelProp() {
          nonEmpty = !nonEmpty;
          editorMirror.setOption("styleActiveLine", {nonEmpty: nonEmpty});
          var label = nonEmpty ? 'Disable nonEmpty option' : 'Enable nonEmpty option';
          document.getElementById('toggleButton').innerText = label;
        }
        
    $('.form-group.field-pages-content.required').click();
   
JS;
        $asset = CodeMirrorSimpleAssets::register($this->view);
        $this->view->registerJs($js, View::POS_END);

        if (!empty($this->modes)) {
            foreach ($this->modes as $mode) {
                $this->view->registerJsFile($asset->baseUrl . '/mode/' . $mode, ['depends' => CodeMirrorSimpleAssets::className()]);
            }
        }


        $out .= '<div class="row"><div class="col-md-12">';
        $out .= Html::textarea($this->name, $this->value, ['id' => $this->id]);
        $out .= '</div></div>';
        return $out;
    }
}