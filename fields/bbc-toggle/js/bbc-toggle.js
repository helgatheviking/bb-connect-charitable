(
	function ( $ ) {

		jQuery( document ).ready( function () {

			BBCToggle = {

				_init: function () {
					$( 'body' ).delegate( '.bbc-toggle .bbc-toggle-label', 'click', BBCToggle._settingsSwitchChanged );

				},


				_settingsSwitchChanged: function () {
					var $this = $( this ),
						switch_wrap = $this.closest( ".bbc-toggle" ),
						this_attr = '#' + $this.attr( 'for' ),
						this_value = switch_wrap.find( this_attr ).val();

					switch_wrap.find( ".bbc-toggle-select" ).val( this_value ).change();
					switch_wrap.find( ".bbc-toggle-select" ).trigger( 'change' );
				},
			};

			BBCToggle._init();

		} );
	}
)( jQuery );