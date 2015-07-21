/* global jQuery, tfTemplateBasedMetaBoxesData */
;( function( Plugin, $, pluginData ) {
	"use strict";

	Plugin.MetaBoxes = {
		initialize: function() {
			this.$templateSelect = $( '#page_template' ).on( 'change', function() {
				Plugin.MetaBoxes.update();
			} );

			this.currentPageTemplate = '';

			var hideSelector = this.getSelector( pluginData.metaBoxes );

			if ( hideSelector.length ) {
				var $hide = $( hideSelector );

				if ( $hide.length ) {
					$hide.hide();
				}
			}

			this.update();
		},
		getSelector: function( metaBoxes ) {
			var selector = '';

			$.each( metaBoxes, function( k, v ) {
				selector += ',#' + v;
			} );

			return selector.substr( 1 );
		},
		update: function() {
			var hide = [],
				show = [],
				pageTemplate = this.$templateSelect.val();

			if ( pluginData.settings[ this.currentPageTemplate ] !== undefined ) {
				hide = pluginData.settings[ this.currentPageTemplate ];
			}

			if ( pluginData.settings[ pageTemplate ] !== undefined ) {
				show = pluginData.settings[ pageTemplate ];
			}

			var temp = hide;

			hide = hide.filter( function( val ) {
				return show.indexOf( val ) == -1;
			} );

			var hideSelector = this.getSelector( hide );

			if ( hideSelector.length ) {
				var $hide = $( hideSelector );

				if ( $hide.length ) {
					$hide.hide();
				}
			}

			show = show.filter( function( val ) {
				return temp.indexOf( val ) == -1;
			} );

			var showSelector = this.getSelector( show );

			if ( showSelector.length ) {
				var $show = $( showSelector );

				if ( $show.length ) {
					$show.show();
				}
			}

			this.currentPageTemplate = pageTemplate;
		}
	};

	$( function() {
		Plugin.MetaBoxes.initialize();
	} );

} )( Plugin, jQuery, tfTemplateBasedMetaBoxesData );
