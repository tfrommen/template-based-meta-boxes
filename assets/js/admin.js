jQuery( function( $ ) {
	'use strict';

	var $templateSelect = $( '#page_template' );
	if ( !$templateSelect.length ) {
		return;
	}

	var localizedData = templateBasedMetaBoxesData;

	var currentPageTemplate = '';
	var settings = localizedData.settings;

	function getSelector( metaBoxes ) {
		var selector = '';

		$.each( metaBoxes, function( k, v ) {
			selector += ',#' + v;
		} );

		return selector.substr( 1 );
	}

	function updateMetaBoxes() {
		var hide = [];
		var show = [];
		var pageTemplate = $templateSelect.val();

		if ( settings[ currentPageTemplate ] !== undefined ) {
			hide = settings[ currentPageTemplate ];
		}

		if ( settings[ pageTemplate ] !== undefined ) {
			show = settings[ pageTemplate ];
		}

		var temp = hide;

		hide = hide.filter( function( val ) {
			return show.indexOf( val ) == -1;
		} );

		var hideSelector = getSelector( hide );
		if ( hideSelector.length ) {
			var $hide = $( hideSelector );

			if ( $hide.length ) {
				$hide.hide();
			}
		}

		show = show.filter( function( val ) {
			return temp.indexOf( val ) == -1;
		} );

		var showSelector = getSelector( show );
		if ( showSelector.length ) {
			var $show = $( showSelector );

			if ( $show.length ) {
				$show.show();
			}
		}

		currentPageTemplate = pageTemplate;
	}

	$templateSelect.change( function() {
		updateMetaBoxes();
	} );

	$( function() {
		var hideSelector = getSelector( localizedData.metaBoxes );

		if ( hideSelector.length ) {
			var $hide = $( hideSelector );

			if ( $hide.length ) {
				$hide.hide();
			}
		}

		updateMetaBoxes();
	} );

} );
