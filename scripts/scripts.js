var site = {

	init: function() {

		$('#contact-form button').click(function() {
			$('#contact-form .loader').addClass('show-loader');
		});

	}
};

$(document).ready(function() { site.init(); });
