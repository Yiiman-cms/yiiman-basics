/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

Vvveb.CodeEditor = {

	isActive: false,
	oldValue: '',
	doc:false,
	codemirror:false,

	init: function(doc=null) {

		if (this.codemirror == false)
		{
			this.codemirror = CodeMirror.fromTextArea(document.querySelector("#vvveb-code-editor textarea"), {
				mode: 'text/html',
				lineNumbers: true,
				autofocus: true,
				lineWrapping: true,
				foldGutter: true,
				gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
				extraKeys: {"Ctrl-Q": function(cm){ cm.foldCode(cm.getCursor()); }},
				//viewportMargin:Infinity,
				theme: 'material'
			});
			var app=this;


			// < Context Menu >
			{
				$.contextMenu({
					selector: '.CodeMirror.CodeMirror-wrap',
					callback: function(key, options) {
						switch (key) {
							case 'translate':
								var text=app.codemirror.getRange( app.codemirror.getCursor(true), app.codemirror.getCursor(false));
								$.ajax({
									url: translateUrl,
									method:'get',
									data:
										{
											"source": "auto",
											"target": langId,
											"text": text
										},
									success:function(res){
										app.codemirror.replaceRange(res,  app.codemirror.getCursor(true),  app.codemirror.getCursor(false), text);
									}
								});

								break;
							case 'rtl':
								app.codemirror.setOption("direction", 'rtl' );
								break;
							case 'ltr':
								app.codemirror.setOption("direction", 'ltr' );
								break;
							case 'delete':
								app.codemirror.setValue("");
								app.codemirror.clearHistory();
								break;
							case 'format':
								CodeMirror.commands["selectAll"](app.codemirror);
								var range = { from: app.codemirror.getCursor(true), to: app.codemirror.getCursor(false) };
								app.codemirror.autoFormatRange(range.from, range.to);
								break;
							case 'showvalue':
								var text=app.codemirror.getRange( app.codemirror.getCursor(true), app.codemirror.getCursor(false));
								$.ajax({
									url:'$parameterValueUrl',
									method:'post',
									data:
										{

											"text": text
										},
									success:function(res){
										sweetAlert("?????? ???? ???????? ???? ?????? ???????? ?????????? ???????? ??????????:",res);
									}
								});

								break;

							case 'createParam':
								paramModal.start();
								break;
						}
					},
					items: {

						"createParam": {name: "?????????? ??????????????", icon: "fa-bolt"},
						"sep1": "---------",
						"translate": {name: "?????????? ?? ????????????", icon: "edit"},
						"showvalue": {name: "?????????? ?????????? ??????????????", icon: "fa-address-card"},
						"sep2": "---------",
						"format": {name: "???????? ???? ?????????? ??????", icon: "fa-align-justify"},

						rtl: {name: "??????????????",icon:"fa-outdent"},
						"ltr": {name: "???? ??????",icon:"fa-indent"},
						"delete": {name: "?????? ???????? ????????", icon: "delete"},
						"sep3": "---------",
						"quit": {name: "Quit", icon: function(){
								return 'context-menu-icon context-menu-icon-quit';
							}}
					}
				});

			}
			// </ Context Menu >

			var totalLines = this.codemirror.lineCount();
			this.codemirror.autoFormatRange({line:0, ch:0}, {line:totalLines});

			this.isActive = true;
			this.codemirror.getDoc().on("change", function (e, v) {
				if (v.origin != "setValue")
				delay(Vvveb.Builder.setHtml(e.getValue()), 1000);
			});
		}



		//_self = this;
		Vvveb.Builder.frameBody.on("vvveb.undo.add vvveb.undo.restore", function (e) { Vvveb.CodeEditor.setValue(e);});
		//load code when a new url is loaded
		Vvveb.Builder.documentFrame.on("load", function (e) { Vvveb.CodeEditor.setValue();});

		this.isActive = true;
		this.setValue();

		return this.codemirror;
	},

	setValue: function(value) {
		if (this.isActive == true)
		{

			var scrollInfo = this.codemirror.getScrollInfo();
			
			this.codemirror.setValue(Vvveb.Builder.getHtml());
			this.codemirror.scrollTo(scrollInfo.left, scrollInfo.top);
		}
	},

	destroy: function(element) {
		/*
		//save memory by destroying but lose scroll on editor toggle
		this.codemirror.toTextArea();
		this.codemirror = false;
		*/
		this.isActive = false;
	},

	toggle: function() {
		if (this.isActive != true)
		{
			this.isActive = true;
			return this.init();
		}
		this.isActive = false;
		this.destroy();
	}
}
