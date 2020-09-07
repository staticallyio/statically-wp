(function ($) {
	'use strict';

	jQuery(document).ready(function () {
		// page tab switch functionality
		if($('[data-stly-tab]').length > 0){
			// display default tab
			var stly_tab_current = document.cookie.replace(/(?:(?:^|.*;\s*)stly_tab\s*\=\s*([^;]*).*$)|^.*$/, "$1");
			if(window.location.hash.substr(1)) {
				stly_tab_current = window.location.hash.substr(1);
			}
			if(!stly_tab_current || !$('[data-stly-tab="'+stly_tab_current+'"]').length) {
				stly_tab_current = $('[data-stly-tab]').first().data('stly-tab');
			}
			stly_display_tab(stly_tab_current) ;
			// tab switch
			$('[data-stly-tab]').click(function(event) {
				stly_display_tab($(this).data('stly-tab'));
				document.cookie = 'stly_tab='+$(this).data('stly-tab');
				$(this).blur();
			});
		}

		$( '#dialog-purge' ).dialog({ autoOpen: false, width: 700 });
		$( '#btn-purge' ).click(function() {
			$( '#dialog-purge' ).dialog( 'open' );
		});

		$( '#dialog-purge-all' ).dialog({ autoOpen: false });
		$( '#btn-purge-all' ).click(function() {
			$( '#dialog-purge-all' ).dialog( 'open' );
		});

		$('#purge-submit').click(function() {
			$('#purge-result').hide();
			$("#purge-ajax-load").show();
			$("#purge-form").ajaxForm({
				target: '#purge-result',
				success: function() 
				{
					$("#purge-ajax-load").hide();
					$('#purge-result').hide().slideDown('fast');
				},
			});
		});

		$('#purge-all-submit').click(function() {
			$('#purge-all-result').hide();
			$("#purge-all-ajax-load").show();
			$("#purge-all-form").ajaxForm({
				target: '#purge-all-result',
				success: function() 
				{
					$("#purge-all-ajax-load").hide();
					$('#purge-all-result').hide().slideDown('fast');
				},
			});
		});

	});

	jQuery(document).on('click', '.statically-illegal-cdnurl-notice .notice-dismiss', function() {

		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: 'statically_illegal_cdnurl_notice_dismiss'
			}
		})
	
	});
})(jQuery);

function stly_display_tab(tab) {
	jQuery('[data-stly-tab]').removeClass('active') ;
	jQuery('[data-stly-tab="'+tab+'"]').addClass('active') ;
	jQuery('[data-stly-layout]').hide() ;
	jQuery('[data-stly-layout="'+tab+'"]').show() ;
}
