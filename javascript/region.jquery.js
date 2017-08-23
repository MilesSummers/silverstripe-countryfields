(function ($) {
	$(document).ready(function () {
		// var $regionsinput = $(this).find("input[name='State'],input.state_regionaldata");
		var $regionsinput = $("input[name='$RegionField']"); 
		var $countryinput = $("select[name=$CountryField]");
		$countryinput.on('change', function () {
			var data = {
				'Country' : $(this).val()
			};
			$regionsinput.attr('disabled','disabled');
			//retrieve list of sub-regions
			$.ajax({
				type : "POST",
				url : "regions/getregions",
				data : data,
				cache : true,
				success : function (response) {
					response = JSON.parse(response);
					if (!response.success || response.regions.length <= 0) {
						replaceRegionInput($('<input />'));
					} else {
						replaceRegionInput(arrayToDropdown(response.regions));
					}
				},
				error : function () {
					replaceRegionInput($('<input />'));
				}
			});
		}).trigger('change');
		
		/**
		 * Create a dropdown from array
		 */
		function arrayToDropdown(data, valfield, labelfield) {
			valfield = valfield || "Title";
			labelfield = labelfield || "Title";
			var s = $('<select />');
			$('<option />').appendTo(s);
			for(var val in data) {
			    $('<option />', {value: data[val][valfield], text: data[val][labelfield]}).appendTo(s);
			}
			return s;
		}
		
		/**
		 * Replace region input field
		 */
		function replaceRegionInput(newinput) {
			old = $regionsinput;
			$regionsinput.replaceWith(newinput);
			$regionsinput = newinput;
			$regionsinput.attr('id', old.attr('id'));
			$regionsinput.attr('name', old.attr('name'));

			if(old.attr('class') == 'text') {
				$regionsinput.removeClass('text');
				$regionsinput.addClass('class', 'dropdown');
			} else $regionsinput.attr('class', old.attr('class'));
			
			$('div#$RegionField').removeClass('text'); $('div#$RegionField').addClass('dropdown');

			$regionsinput.removeAttr('disabled');
			$regionsinput.val(old.val());
		}
		
	});
})(jQuery);
