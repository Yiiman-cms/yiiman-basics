<?php
	/**
	 * Created by tokapps TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Company Phone:05138846411
	 * Site:http://tokapps.ir
	 * Date: 03/22/2020
	 * Time: 17:57 PM
	 */
	
	use YiiMan\YiiBasics\widgets\mobileInput\assets\MobileInputAsset;
	
	/**
	 * @var $this      \YiiMan\YiiBasics\lib\View
	 * @var $name      string
	 * @var $id        string
	 * @var $country   string
	 * @var $value     string
	 */
	$asset = MobileInputAsset::register( $this );
	$utils = $asset->baseUrl . '/js/utils.js';
	$js    = <<<JS
var phone = document.querySelector("#$id");
    var intl=window.intlTelInput(phone, {
    	utilsScript: "$utils",
    	geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "";
          $('[name="$country"]').val(countryCode);
          callback(countryCode);
        });
      },
      autoHideDialCode:false,
      formatOnDisplay:true,
      initialCountry:"auto",
      nationalMode :true,
      separateDialCode:false,
      preferredCountries:["ir"]
    });
    phone.addEventListener("countrychange", function(e) {
        let countryCode=intl.getSelectedCountryData().iso2;
	   $('[name="$country"]').val(countryCode);
});
JS;
	$this->registerJs( $js , $this::POS_END );
?>
<input type="hidden" name="<?= $country ?>">
<input id="<?= $id ?>" value="<?= $value ?>" class="mobileinput form-control" name="<?= $name ?>" type="tel">
