(function ( $ ) {
	window.InlineShortcodeView_photo_panorama_el = window.InlineShortcodeView.extend( {
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_photo_panorama_el.__super__.render.call( this );

			vc.frame_window.vc_iframe.addActivity( function () {
				if ( 'undefined' !== typeof(this.Ph_El_Viewer) ) {
					this.Ph_El_Viewer( model_id );
				}

			} );
			return this;
		},
		changed: function () {
			var modelId = this.model.get( 'id' );

			window.InlineShortcodeView_photo_panorama_el.__super__.changed.call( this );
			if ( 'undefined' !== typeof(vc.frame_window.Ph_El_Viewer) ) {
				_.defer( function () {
					vc.frame_window.Ph_El_Viewer( modelId );
				} );
			}
			return this;
		}
	} );
})( window.jQuery );
