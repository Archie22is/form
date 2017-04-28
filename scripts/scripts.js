var site = {
	contactForm: $('.contact-form'),
	contactFormMessages: $('.form-messages'),
	formData: null,
	init: function() {

/* Form
============================= */

		// Placeholder text fallback
		if (!Modernizr.input.placeholder) {

			$('[placeholder]').focus(function() {
				var input = $(this);
			  	if (input.val() == input.attr('placeholder')) {
					input.val('');
					input.removeClass('placeholder');
			  	}
			}).blur(function() {
			  	var input = $(this);
			  	if (input.val() === '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
			  	}
			}).blur();
			$('[placeholder]').parents('form').submit(function() {
			 	$(this).find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
				  		input.val('');
					}
				});
			});

		}

		// Contact Form Validation and submit via Ajax
		$('.contact-form').validate({
			errorContainer: '.error-messages',
			errorLabelContainer: '.error-messages .container',
			rules: {
				name: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				message: {
					required: true
				}
			},
			messages: {
				name: {
					required: 'Please enter your full name'
				},
				email: {
					required: 'Please enter your email address',
					email: 'Please enter your email in the correct format (you@yourdomain.com)'
				},
				message: {
					required: 'Please enter your message'
				}
			},
			submitHandler: function(form) {
				// Serialize the data from the form to allow it to be sent
				site.formData = $('.contact-form').serialize();

				// Submit the form using Ajax
				$.ajax({
					type: 'POST',
					url: $('.contact-form').attr('action'),
					data: site.formData
				}).done(function(response) {
					// Add correct class to messages div
					$(site.contactFormMessages).removeClass('error').addClass('success');

					// Set the message text
					$(site.contactFormMessages).text(response);

					// Clear the form
					$('#name').val('');
					$('#email').val('');
					$('#message').val('');

				}).fail(function(data) {
					// Add correct class to messages div
					$(site.contactFormMessages).removeClass('success').addClass('error');

				    // Set the message text.
				    if (data.responseText !== '') {
				        $(site.contactFormMessages).text(data.responseText);
				    } else {
				        $(site.contactFormMessages).text('Oops! An error occured and your message could not be sent.');
				    }
				});
			}
		});

	}
};

$(document).ready(function() { site.init(); });
