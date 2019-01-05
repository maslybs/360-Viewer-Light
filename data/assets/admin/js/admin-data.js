var PSV_ADMIN_PANORAMA = {};

PSV_ADMIN_PANORAMA.$ = jQuery;

PSV_ADMIN_PANORAMA.footerPanelID = 'panorama_footer_wrapper';

PSV_ADMIN_PANORAMA.featherlight = function ($row, $input, viewer_params, view) {
	$.featherlight('<div id="viewer"></div><input type="hidden" class="temp-coordinates" value=""><button class="save-coordinates">Save coordinates</button>', {
		type        : 'html',
		closeOnClick: false,
		afterOpen   : function () {

			$longitude = $row.find('[data-setting="longitude"]');
			$latitude = $row.find('[data-setting="latitude"]');

			if ($row.hasClass('vc_ui-panel')) {
				$longitude = $input.closest('.vc_param_group-wrapper').find('.vc_param-name-markers_longitude');
				$latitude = $input.closest('.vc_param_group-wrapper').find('.vc_param-name-markers_latitude');
			}

			viewer_params.markers[0] = {
				id       : '#' + Math.random(),
				longitude: $longitude.val(),
				latitude : $latitude.val(),
				anchor   : 'bottom center',
				circle   : 20,
				tooltip  : 'Your coordinates for the marker.',
				svgStyle : {
					fill: 'rgba(255, 0, 0, 0.5)'
				},
				data     : {
					generated: true
				}
			};

			if (!$longitude.val()) {
				viewer_params.markers[0].longitude = 0;
			}

			if (!$latitude.val()) {
				viewer_params.markers[0].latitude = 0;
			}

			if (!view) {
				val = $input.val().split(',');
				if (val[1]) {
					viewer_params.markers[0].longitude = val[0];
					viewer_params.markers[0].latitude = val[1];
				}
			}

			var viewer = new PhotoSphereViewer(viewer_params);

			if (!view) {
				var id_image = $row.find('.panorama.attach_image').val();
				wp.media.attachment(id_image).fetch().then(function (data) {
					// preloading finished
					// after this you can use your attachment normally
					viewer.setPanorama(wp.media.attachment(id_image).get('url'));
				});
			}

			viewer.on('click', function (e) {

				viewer_params.markers[0].longitude = e.longitude;
				viewer_params.markers[0].latitude = e.latitude;

				viewer.updateMarker(viewer_params.markers[0]);

				// save to temp data
				$('.temp-coordinates').val(e.longitude + ',' + e.latitude);

			});

			$('.save-coordinates').on('click', function () {

				var temp = $('.temp-coordinates').val();

				if (temp) {

					$input.val(temp);
					temp = temp.split(',');
					$longitude.val(temp[0]).trigger('input');
					$latitude.val(temp[1]).trigger('input');
				}

				// close popup
				$.featherlight.current().close();

				return false;

			})
		}
	});

}

// Add modal to choose coordinates on image
PSV_ADMIN_PANORAMA.openModalCoordinates = function (_this, panel, model, view) {

	var $ = jQuery,
			$input = $(_this),
			$row = $input.closest('.elementor-repeater-row-controls, .vc_ui-panel'),

			viewer_params = {
				container: 'viewer',
				panorama : '',
				size     : {
					width : ($(window).width() * 70) / 100,
					height: (($(window).height() * 90) / 100) - 80
				},
				markers  : [],
				navbar   : false,
				time_anim: false,
				mousemove: true
			};

	/* For Elementor */
	if (view) {
		var $viewer = view.$el.find('.ps-el-viewer'),
				params = $viewer.data('ps-params');
		viewer_params.panorama = params.panorama;

		if (params.virtual_tour_enable && params.virtual_tour) {

			var iframe = $('#elementor-preview-iframe').get(0),
					iframewindow = iframe.contentWindow ? iframe.contentWindow : iframe.contentDocument.defaultView,
					PSV_VIEWER = iframewindow.ELANTA_VIEWERS[$viewer.attr('id')],
					scenes = PSV_VIEWER.config.virtual_tour;

			let id = $row.find('.elementor-control-show_in_scene input').val();
			id = id ? id : 1;
			viewer_params.panorama = scenes[id - 1].url;
		}
	}

	/* For WPBakery */
	if ($row.hasClass('vc_ui-panel')) {

		var $panel = vc.active_panel.$el,
				panorama = vc.active_panel.$el.find('input.panorama').val(),
				scenes = panorama + ',' + $panel.find('input.virtual_tour').val();

		scenes = scenes.split(',');

		var show_in_scene = $input.closest('.vc_param').find('input.markers_show_in_scene').val();
		show_in_scene = show_in_scene ? show_in_scene : 1;
		var id = scenes[show_in_scene - 1];

		wp.media.attachment(id).fetch().then(function (data) {
			// preloading finished
			// after this you can use your attachment normally
			viewer_params.panorama = wp.media.attachment(id).get('url');
			PSV_ADMIN_PANORAMA.featherlight($row, $input, viewer_params, view);
		});

	} else {
		this.featherlight($row, $input, viewer_params, view);
	}

}

PSV_ADMIN_PANORAMA.makeid = function () {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 5; i++) {
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	}

	return text;
}

PSV_ADMIN_PANORAMA.switcherEvents = function (view) {

	var container_id = view.$el.find('.ps-el-viewer').attr('id');

	$('.panorama-switcher-item').off('click').on('click', function () {

		var iframe = $('#elementor-preview-iframe').get(0),
				iframewindow = iframe.contentWindow ? iframe.contentWindow : iframe.contentDocument.defaultView,
				psv_core = iframewindow.ELANTA_VIEWERS[container_id],
				tours = Object.assign([], psv_core.config.virtual_tour),
				scene_id = $(this).data('id');

		psv_core.clearMarkers(psv_core.config);

		if (tours[scene_id].markers) {

			for (var i in tours[scene_id].markers) {

				psv_core.addMarker(tours[scene_id].markers[i]);

			}
		}
		psv_core.setPanorama(tours[scene_id].url, null, true);

	});

}

/*
* Add switcher of scene
*
* */
PSV_ADMIN_PANORAMA.updateFooterPanel = function (model, panel, view) {

	var settings = model.get('settings'),
			params = settings.attributes,
			tours = Object.assign([], params.virtual_tour),
			_parent = this;

	tours.unshift(params.panorama);

	var switcher = doT.template($('#panorama_switcher').text(), undefined, {});

	if (!panel.$el.find('#' + _parent.footerPanelID).length) {
		panel.$el.find('#elementor-panel-footer').prepend('<div id="' + _parent.footerPanelID + '"></div>')
	}

	var data = {
		data: tours
	};

	if (tours.length < 5) {
		data.show_label = true;
	}

	panel.$el.find('#' + this.footerPanelID).html(switcher(data)).promise().done(function () {
		_parent.switcherEvents(view);
	});

	if (!params.virtual_tour_enable) {
		panel.$el.find('#' + _parent.footerPanelID).hide();
	} else {
		panel.$el.find('#' + _parent.footerPanelID).show();
	}

}

PSV_ADMIN_PANORAMA.initElementorHooks = function () {

	var _parent = this;

	if (window.elementor) {


		elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {

			if (model.get('widgetType') !== 'elenta_viewer_el') {
				panel.$el.find('#' + _parent.footerPanelID).hide();
			}
		});


		elementor.hooks.addAction('panel/open_editor/widget/elenta_viewer_el', function (panel, model, view) {


			view.on('render', function () {
				_parent.switcherEvents(view);
			});

			// add switcher to Panel
			_parent.updateFooterPanel(
					model,
					panel,
					view
			);

			var panel_controls = panel.$el.find('#elementor-controls');

			panel_controls.on('click', '.elementor-control-gallery-add,.elementor-control-gallery-thumbnails', function () {
				wp.media.frame.on('all', function (e) {

					if (e === 'change') {

						// add switcher to Panel
						_parent.updateFooterPanel(
								model,
								panel,
								view
						);

					}
				});
			});

			$('body').on('click', '.dialog-confirm-ok', function () {
				// add switcher to Panel
				_parent.updateFooterPanel(
						model,
						panel,
						view
				);
			});

			panel_controls.on('change', '.elementor-control-virtual_tour_enable input', function () {

				// add switcher to Panel
				_parent.updateFooterPanel(
						model,
						panel,
						view
				);

			});

			panel_controls.off("click", ".elementor-control-add_coordinate input").on('click', '.elementor-control-add_coordinate input', function () {

				_parent.openModalCoordinates(this, panel, model, view);

			});

		});
	}

}

jQuery(window).on('load', function () {

	PSV_ADMIN_PANORAMA.initElementorHooks();

});

jQuery('.vc_ui-panel-window').off('click', '[name="markers_add_coordinate"]').on('click', '[name="markers_add_coordinate"]', function () {
	PSV_ADMIN_PANORAMA.openModalCoordinates(this);
});
