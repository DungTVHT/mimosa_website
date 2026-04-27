/** global wcbk_admin */
jQuery( document ).ready( function ( $ ) {
    "use strict";

    /** ------------------------------------------------------------------------
     *  Settings Section - Toggle
     * ------------------------------------------------------------------------- */
    $( document ).on( 'click', '.yith-wcbk-settings-section__toggle', function ( event ) {
        var _toggle  = $( event.target ),
            _section = _toggle.closest( '.yith-wcbk-settings-section' ),
            _content = _section.find( '.yith-wcbk-settings-section__content' );

        if ( _section.is( '.yith-wcbk-settings-section--closed' ) ) {
            _content.slideDown( 400 );
        } else {
            _content.slideUp( 400 );
        }

        _section.toggleClass( 'yith-wcbk-settings-section--closed' );
    } );

    /** ------------------------------------------------------------------------
     *  Settings Section Box - Sortable
     * ------------------------------------------------------------------------- */
    function yith_wcbk_settings_section_box_sortable_row_indexes( element ) {
        var _container = element.closest( '.yith-wcbk-settings-section-box__sortable-container' );
        _container.find( '.yith-wcbk-settings-section-box' ).each( function ( index, el ) {
            $( '.yith-wcbk-settings-section-box__sortable-position', el ).val( parseInt( $( el ).index( '.yith-wcbk-settings-section-box__sortable-container .yith-wcbk-settings-section-box' ), 10 ) );
        } );
    }

    $( '.yith-wcbk-settings-section-box__sortable-container' ).sortable( {
                                                                             items               : '.yith-wcbk-settings-section-box',
                                                                             cursor              : 'move',
                                                                             handle              : '.yith-wcbk-settings-section-box__sortable-anchor',
                                                                             axis                : 'y',
                                                                             scrollSensitivity   : 40,
                                                                             forcePlaceholderSize: true,
                                                                             opacity             : 0.65,
                                                                             helper              : function ( e, row ) {
                                                                                 var originals = row.children(),
                                                                                     helper    = row.clone();
                                                                                 helper.children().each( function ( index ) {
                                                                                     // Set helper cell sizes to match the original sizes
                                                                                     $( this ).width( originals.eq( index ).width() );
                                                                                 } );
                                                                                 return helper;
                                                                             },
                                                                             stop                : function ( event, ui ) {
                                                                                 yith_wcbk_settings_section_box_sortable_row_indexes( ui.item );
                                                                             }
                                                                         } );

    /** ------------------------------------------------------------------------
     *  Settings Section Box - Toggle
     * ------------------------------------------------------------------------- */
    $( document ).on( 'click', '.yith-wcbk-settings-section-box__toggle', function ( event ) {
        var _toggle  = $( event.target ),
            _section = _toggle.closest( '.yith-wcbk-settings-section-box' ),
            _content = _section.find( '.yith-wcbk-settings-section-box__content' );

        if ( _section.is( '.yith-wcbk-settings-section-box--closed' ) ) {
            _content.slideDown( 400 );
        } else {
            _content.css( { display: 'block' } );
            _content.slideUp( 400 );
        }

        _section.toggleClass( 'yith-wcbk-settings-section-box--closed' );
    } );

    /** ------------------------------------------------------------------------
     *  Settings Section Box - Edit Title
     * ------------------------------------------------------------------------- */
    $( document ).on( 'change keyup', '.yith-wcbk-settings-section-box__edit-title', function ( event ) {
        var _edit_input = $( event.target ),
            _section    = _edit_input.closest( '.yith-wcbk-settings-section-box' ),
            _title      = _section.find( '.yith-wcbk-settings-section-box__title h3' ).first();

        if ( _title.length ) {
            _title.html( _edit_input.val() || wcbk_admin.i18n_untitled );
        }
    } );
} );