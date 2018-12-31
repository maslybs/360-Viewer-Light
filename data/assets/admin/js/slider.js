!function( $ ) {
	$( ".vc-slider" ).each( function() {

		var $this = $(this),
			$parent = $this.parent(),
			params = $this.data( 'params' );

		var value = $parent.find( "input" ).val() || 0;


		$this.slider( {
			range: "min",
			value: value,
			step: params.range.px.step !== undefined ? params.range.px.step : 1,
			min: params.range.px.min !== undefined  ? params.range.px.min : 0,
			max: params.range.px.max !== undefined  ? params.range.px.max : 360,
			slide: function( event, ui ) {
				$parent.find( "input" ).val( ui.value );
			}
		} );
	} );

}( window.jQuery );