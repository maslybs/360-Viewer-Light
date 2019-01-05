/*
* Panorama Viewer
*/
jQuery(function () {

    var $ = jQuery,
        $viewer,
        viewer_params,
        debug = false;

    window.ELANTA_VIEWERS = [];

    var some_default_params = [
        'time_anim',
        'mousewheel',
        'mousemove',
        'mousemove_hover',
    ];

    window.Ph_El_Viewer = function () {
        // each all maps
        $('.ps-el-viewer').each(function (i) {

            // variables
            $viewer = $(this);

            if ($viewer.find('.psv-container').length) {
                return;
            }

            viewer_params = $viewer.data('ps-params');

            // add id container to the params
            viewer_params.container = this.id;

            $parent_section = $viewer.closest('.elementor-section, .vc_column-inner');

            jQuery.each(viewer_params, function (i, val) {
                if (val === "true" || val === "false") {
                    viewer_params[i] = !!val;
                }
            });

            for (var i in viewer_params.markers) {

                let marker = viewer_params.markers[i];

                if (marker['html']) {
                    marker['html'] = decodeURIComponent(escape(atob(marker['html'])));
                }

                if (marker['content']) {
                    marker['content'] = decodeURIComponent(escape(atob(marker['content'])));
                }

                if (marker['circle']) {
                    marker['circle'] = parseInt(viewer_params.markers[i]['circle']);
                }

                viewer_params.markers[i] = marker;

            }

            jQuery.each(some_default_params, function (i, val) {
                if (viewer_params[val] === 0) {
                    viewer_params[val] = false;
                } else {
                    if (val === 'time_anim' && viewer_params[val]) {
                        viewer_params[val] = parseInt(viewer_params[val]);
                    }
                }
            });

            if (viewer_params.type_height === 'fullheight') {
                var height = $parent_section.outerHeight(true);
                if (height <= 1) {
                    height = $(window).height();
                }

                viewer_params.size.height = height;
                $viewer.css({
                    'height': $parent_section.outerHeight(true) + 'px'
                });

            }

            if (viewer_params.as_bg) {

                var parent_top = 0;
                if ($parent_section.length) {
                    parent_top = $parent_section.offset().top;

                }

                if ($viewer.offset().top !== undefined) {

                    $viewer.css({
                        'top': '-' + (($viewer.offset().top - parent_top) + 10) + 'px'
                    });
                }

                $viewer.closest('.elementor-widget').css({
                    'height': 0,
                    'margin': 0
                });
            } else {
                $viewer.closest('.elementor-widget').removeAttr('style');
            }

            // debug all params
            debug && console.dir(viewer_params);

            // init PhotoSphereViewer
            ELANTA_VIEWERS['ps_el_' + viewer_params.container_id] = new PhotoSphereViewer(viewer_params);

        });

        for (var key in ELANTA_VIEWERS) {

            let psv = ELANTA_VIEWERS[key];

            psv.on('select-marker', function (marker) {


                var config = this.config;


                if (marker['marker_action'] == 'url' || marker['marker_action'] == 'product') {

                    var _blank = false;
                    if (marker['marker_action_url'].is_external == 'on' || marker['marker_action_url'].target) {
                        window.open(marker['marker_action_url'].url, '_blank');
                    } else {
                        window.location.href = marker['marker_action_url'].url;
                    }

                }

            });

        }

    };

    jQuery(window).on('load', function () {
        Ph_El_Viewer();
    });

    jQuery(window).on('orientationChange', function () {
        Ph_El_Viewer();
    });

    if (window.elementorFrontend && elementorFrontend.hooks) {

        elementorFrontend.hooks.addAction('frontend/element_ready/global', function (panel, model, view) {
            Ph_El_Viewer();
        });

        elementorFrontend.hooks.addAction('panel/open_editor/widget/photospherevc', function (panel, model, view) {

            view.onRender = function () {
                Ph_El_Viewer();
            }

        });

    }

    if (window.elementor && elementor.hooks) {

        elementor.hooks.addAction('panel/open_editor/section/section', function (panel, model, view) {

            window.Ph_El_Viewer();
        });

        elementor.hooks.addAction('panel/open_editor/widget', function (panel, model, view) {

            window.Ph_El_Viewer();
        });

    }


});
