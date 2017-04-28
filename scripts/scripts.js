var site = {

	init: function() {

		$('#contact-form button').click(function() {
			$('#contact-form .loading').addClass('show-loader');
		});

	}
};

$(document).ready(function() { site.init(); });
