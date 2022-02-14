<?php
/**
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

/**
 * @date_of_create: 2/10/2022 AD 07:33
 */

namespace YiiMan\YiiBasics\modules\pages\ThemComponents\Inputs;

class ImageInput extends BaseInputs
{

    public function __construct( $htmlAttributeName = null)
    {
        $this->htmlAttributeName = (string) $htmlAttributeName;
    }

    public static function JsExtendCode(): string
    {
        return <<<JS
$.extend({}, Input, {

    events: [
        ["blur", "onChange", "input[type=text]"],
        ["change", "onUpload", "input[type=file]"],
	 ],

	setValue: function(value) {

		//don't set blob value to avoid slowing down the page		
		if (value.indexOf("data:image") == -1)
		{
				$('input[type="text"]', this.element).val(value);
		}else{
			console.log('ok');
		}




	},

	onUpload: function(event, node) {

		if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
            //reader.readAsBinaryString(this.files[0]);
            file = this.files[0];
        }

		function imageIsLoaded(e) {
				
				image = e.target.result;
				console.log(e);
				var elem=this;
				try{
					event.data.element.trigger('propertyChange', [image, elem]);
				}catch (e) {

				}

				//return;//remove this line to enable php upload

				var formData = new FormData();
				formData.append("file", file);
    
				$.ajax({
					type: "POST",
					url: uploadUrl,//set your server side upload script url
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						console.log("File uploaded at: ", data);
						
						//if image is succesfully uploaded set image url
						event.data.element.trigger('propertyChange', [data, elem]);
						
						//update src input
						try{
							$('input[type="text"]', event.data.element).val(data);
						}catch (e) {

						}

					},
					error: function (data) {
						alert(data.responseText);
					}
				});		
		}
	},

	init: function(data) {
		return this.render("imageinput", data);
	},
  })
JS;

    }


    public static function htmlTemplate(): string
    {
        return <<<HTML

       <div>
            <input name="{%=key%}" type="text" class="form-control"/>
            <input name="file" type="file" class="form-control"/>
        </div>
HTML;

    }
}