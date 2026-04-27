/* global wcbk_admin */
jQuery( document ).ready( function ( $ ) {
    "use strict";

    /**
     * Add expand/collapse toggle if there are more than one title
     */
    var titles = $( '.yith-plugin-fw.yit-admin-panel-container h2' );

    if ( true || titles.length > 1 ) {
        titles.append( $( '<span class="dashicons dashicons-arrow-down-alt2 yith-wcbk-collapse-toggle" ></span>' ) );

        $( '.yith-plugin-fw.yit-admin-panel-container #plugin-fw-wc > table' ).each( function () {
            var table   = $( this ),
                wrapper = $( '<div class="yith-wcbk-fake-table-container" />' );

            table.after( wrapper );
            wrapper.append( table );
        } );

        $( '.yith-plugin-fw.yit-admin-panel-container h2 .yith-wcbk-collapse-toggle' ).on( 'click', function ( e ) {
            var title = $( this ).closest( 'h2' ),
                table = title.next( '.yith-wcbk-fake-table-container' );

            if ( title.is( '.collapsed' ) ) {
                title.removeClass( 'collapsed' );
                table.slideDown( 400 );
            } else {
                title.addClass( 'collapsed' );
                table.slideUp( 400 );
            }
        } );
    }
} );